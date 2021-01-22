<div class="container py-5 px-4">
  <!-- For demo purpose-->
  <div class="text-center">
    <div class="title" style="padding-bottom: 3px; padding-top: 10px;">Vos chats</div>
    </div>

  <div class="row rounded-lg overflow-hidden shadow" style="margin-top: 5px;">
    <!-- Users box-->
    <div class="col-md-5 px-0 matchs">
      <div class="bg-white">

        <div class="bg-gray px-3 py-2 bg-light">
            <p class="h5 mb-0 py-1">
                Récent
            </p>
        </div>

        <div class="messages-box">
          <div class="list-group rounded-0" id="chat_history">
            
          </div>
        </div>
      </div>
    </div>
    <!-- Chat Box-->
    <div class="col-md-7 px-0 disscution">
      <div class="px-4 py-5 chat-box bg-white" id="focused_conv_messages">

      </div>

      <!-- Typing area -->
      <form action="#" class="bg-light">
        <div class="input-group">
          <input id="messageInput" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
          <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link" style="background-color: lightblue;" onclick="sendMessage();"> 
                <svg width="2em" height="1em" viewBox="0 0 16 16" class="bi bi-cursor-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
                </svg>
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<script>

var last_chat = null;

function switchFocusedChat(a) {
    if (a.id.split("_").length == 3) {
        var idStr = a.id.split("_")[2];
        if (!isNaN(idStr)) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://localhost/php/chat/switch_focused_chat.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                var result = JSON.parse(this.responseText);
                if (result.reload_chat) {
                    document.getElementById("messageInput").value = "";
                    reload_chat();
                }
            };
            xhr.send('conv_id=' + idStr);
        }
    }
}

function sendMessage() {
    var msgText = document.getElementById("messageInput").value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/php/chat/send_message.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        var item = {
            text: this.responseText,
            relative_time: "just now"
        };
        var history_item = last_chat.chat_history.find(x => x.conv_id == last_chat.focused_chat.conv_id);
        if (history_item != undefined) {
            history_item.relative_date = "just now";
            history_item.msg = "Moi: " + this.responseText;
            document.getElementById("history_conv_" + last_chat.focused_chat.conv_id).innerHTML = focused_history_item_update_html(history_item);
            document.getElementById("focused_conv_messages").innerHTML += sent_message_html(item);
        }
    };
    xhr.send('msg=' + msgText);
    document.getElementById("messageInput").value = "";
    document.getElementById("focused_conv_messages").scrollTop = document.getElementById("focused_conv_messages").scrollHeight;
}

function history_item_html(item) {
    var html = '<a onclick="switchFocusedChat(this);" class="list-group-item list-group-item-action list-group-item-light rounded-0" id="history_conv_' + item.conv_id + '">';
        html += '<div class="media"><img src="' + item.img + '" alt="user" width="50" class="rounded-circle">';
            html += '<div class="media-body ml-4 lastMsg">';
                html += '<div class="d-flex align-items-center justify-content-between mb-1">';
                    html += '<h6 class="mb-0">' + item.conv_name + '</h6><small class="small font-weight-bold">' + item.relative_date + '</small>';
                html += '</div>';
                html += '<p class="font-italic text-muted mb-0 text-small">' + item.msg + '</p>';
            html += '</div>';
        html += '</div>';
    html += '</a>';
    return (html);
}

function focused_history_item_update_html(item) {
    var html = '<div class="media"><img src="' + item.img + '" alt="user" width="50" class="rounded-circle">';
            html += '<div class="media-body ml-4 lastMsg">';
                html += '<div class="d-flex align-items-center justify-content-between mb-1">';
                    html += '<h6 class="mb-0">' + item.conv_name + '</h6><small class="small font-weight-bold">' + item.relative_date + '</small>';
                html += '</div>';
                html += '<p class="font-italic mb-0 text-small">' + item.msg + '</p>';
            html += '</div>';
        html += '</div>';
    return (html);
}

function focused_history_item_html(item) {
    var html = '<a class="list-group-item list-group-item-action active text-white rounded-0" id="history_conv_' + item.conv_id + '">';
        html += '<div class="media"><img src="' + item.img + '" alt="user" width="50" class="rounded-circle">';
            html += '<div class="media-body ml-4 lastMsg">';
                html += '<div class="d-flex align-items-center justify-content-between mb-1">';
                    html += '<h6 class="mb-0">' + item.conv_name + '</h6><small class="small font-weight-bold">' + item.relative_date + '</small>';
                html += '</div>';
                html += '<p class="font-italic mb-0 text-small">' + item.msg + '</p>';
            html += '</div>';
        html += '</div>';
    html += '</a>';
    return (html);
}

function sent_message_html(item) {
    var html = '<div class="media w-50 ml-auto mb-3">';
            html += '<div class="media-body">';
                html += '<div class="bg-primary rounded py-2 px-3 mb-2">';
                    html += '<p class="text-small mb-0 text-white">' + item.text + '</p>';
                html += '</div>';
                html += '<p class="small text-muted">' + item.relative_time + '</p>';
            html += '</div>';
        html += '</div>';
    return (html);
}

function recieved_message_html(item, circle_img) {
    console.log(item);
    var html = '<div class="media w-50 mb-3"><img src="' + circle_img + '" alt="user" width="50" class="rounded-circle">';
            html += '<div class="media-body">';
                html += '<div class="bg-primary rounded py-2 px-3 mb-2">';
                    html += '<p class="text-small mb-0 text-white">' + item.text + '</p>';
                html += '</div>';
                html += '<p class="small text-muted">' + item.relative_time + '</p>';
            html += '</div>';
        html += '</div>';
    return (html);
}

function reload_chat() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            //last_chat = result;
            document.getElementById("chat_history").innerHTML = "";
            result.chat_history.forEach(el => {
                if (el.conv_id == result.focused_chat.conv_id) {
                    document.getElementById("chat_history").innerHTML += focused_history_item_html(el);
                } else {
                    document.getElementById("chat_history").innerHTML += history_item_html(el);
                }
            });
            document.getElementById("focused_conv_messages").innerHTML = "";

            if (result.focused_chat.conv_id == -1) {
                document.getElementById("messageInput").disabled = true;
            } else {
                document.getElementById("messageInput").disabled = false;
            }

            result.focused_chat.messages.forEach(el => {
                if (el.sent) {
                    document.getElementById("focused_conv_messages").innerHTML += sent_message_html(el);
                } else {
                    document.getElementById("focused_conv_messages").innerHTML += recieved_message_html(el, result.focused_chat.circle_img);
                }
            });
            if (last_chat == null) {
                document.getElementById("focused_conv_messages").scrollTop = document.getElementById("focused_conv_messages").scrollHeight;
            } else {
                if (last_chat.focused_chat.conv_id != result.focused_chat.conv_id) {
                    document.getElementById("focused_conv_messages").scrollTop = document.getElementById("focused_conv_messages").scrollHeight;
                } else if (last_chat.focused_chat.messages.length != result.focused_chat.messages.length) {
                    document.getElementById("focused_conv_messages").scrollTop = document.getElementById("focused_conv_messages").scrollHeight;
                }
            }
            last_chat = result;
        }
    };
    xhttp.open("GET", "http://localhost/php/chat/load_chat.php", true);
    xhttp.send();
}
reload_chat();

setInterval(function(){
    reload_chat();
}, 1000);
</script>