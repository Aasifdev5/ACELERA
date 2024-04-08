$(document).ready(function () {
    if ($('#messages-container').is(':empty')) {
        $('#select-user').html('<h6>Select a chat or start a new conversation!</h6>');
        $('.chat-box').hide();
    }
});

function getMessages(senderId, receiverId, campaign_id) {

    let roleType = $('#senderRole').val();
    $('.course-list .course-title').removeClass('active');
    if (roleType == 2 || roleType == 4) {
        $('.course-' + campaign_id + '-' + receiverId).addClass('active');
        $('#course-title').html($('.course-' + campaign_id + '-' + receiverId + ' .title').text());
        $('#chat-user-name').html($('.course-' + campaign_id + '-' + receiverId).closest('li').find('.user-name').text());
    } else if (roleType == 3) {
        $('.course-' + campaign_id).addClass('active');
        $('#course-title').html($('.course-' + campaign_id + ' .title').text());
        $('#chat-user-name').html($('.course-' + campaign_id).closest('li').find('.user-name').text());
    }

    $('#chat-error').empty();
    $('#receiverId').val(receiverId);
    $('#campaign_id').val(campaign_id);
    unseenCount(receiverId, campaign_id);
    let messageContainer = $('#messages-container');
    let fetchMessageUrl = $('#chatMessage').val();

    $.ajax({
        url: fetchMessageUrl,
        data: {
            'receiverId': receiverId,
            'senderId': senderId,
            'campaign_id': campaign_id
        },
        type: 'get',
        success: function (res) {

            $('.chat-box').show();
            $('#select-user').hide();
            let messagesHtml = '';
            if (res.messages.length == 0) {
                loadMore = false;
                messagesHtml = '<div class="no-message">No messages found.</div>';
            } else {
                res.messages.forEach(message => {
                    const messageClass = message.sender_id == senderId ? 'sender' : 'receiver';
                    messagesHtml += `
                        <div class="chat-message ${messageClass}">
                            <h6 class="message-text">${message.message}</h6>
                        </div>`;
                });
            }
            messageContainer.html(messagesHtml);
            messageContainer.scrollTop(messageContainer[0].scrollHeight);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

$('#chat-send').submit(function (e) {
    e.preventDefault();
    let message = $('#chat-message').val();
    let senderId = $('#senderId').val();
    let receiverId = $('#receiverId').val();
    let campaign_id = $('#campaign_id').val();
    let url = $('#chatSend').val();

    if (!message) {
        $('#chat-error').html('<p class="text-danger fw-bold text-center">' +
            'message cannot be empty!</p>')
    }
    else {
        $.ajax({
            url: url,
            type: 'post',
            data: {
                sender_id: senderId,
                receiver_id: receiverId,
                course_id: campaign_id,
                message: message
            },
            success: function (res) {
                $('#chat-message').val('');
                $('#chat-error').empty();
                getMessages(senderId, receiverId, campaign_id)
            },
            error: function (error) {
                console.log(error)
            }
        })
    }
});

function getPusherMessages(senderId, receiverId, campaign_id, message) {
    let receiver = $('#receiverId').val();
    let sender = $('#senderId').val();
    let course = $('#campaign_id').val();
    let messageContainer = $('#messages-container');
    let messagesHtml = '';
    if (senderId == receiver && receiverId == sender && campaign_id == course) {
        let messageClass = 'receiver';
        messagesHtml = `
        <div class="chat-message ${messageClass}">
            <h6 class="message-text">${message}</h6>
        </div>`;
        messageContainer.prepend(messagesHtml);
        messageContainer.scrollTop(messageContainer[0].scrollHeight);
    }
}

function unseenCount(userId, campaign_id) {
    let selectedReceiverId = $('#receiverId').val();
    let selectedcampaign_id = $('#campaign_id').val();

    if (selectedcampaign_id == campaign_id && selectedReceiverId == userId) {
        let unseenElement = $('#unseen-' + userId + '-' + campaign_id);
        unseenElement.text('');
        unseenElement.siblings('.notification-icon').addClass('d-none');
    } else {
        let unseenElement = $('#unseen-' + userId + '-' + campaign_id);
        let unseenCount = parseInt(unseenElement.text() || 0);
        unseenCount++;
        unseenElement.text(unseenCount.toString());
        if (unseenCount > 0) {
            unseenElement.siblings('.notification-icon').removeClass('d-none');
        } else {
            unseenElement.siblings('.notification-icon').addClass('d-none');
        }
    }
}
