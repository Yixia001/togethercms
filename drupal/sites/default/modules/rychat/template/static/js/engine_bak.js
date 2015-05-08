/**
 * 本代码中的SDK代码均为最新版0.9.8版本
 * 修改本Demo的代码时注意SDK版本兼容性
 * Author:张亚涛
 * Date:2015-4-24
 */
jQuery.noConflict();  
(function ($) {
    //私有变量
	Drupal.behaviors.rychat = {
		    attach: function (context, settings) {
	var basepath = Drupal.settings.rychat.basePath;
	//alert(basepath);
    var currentConversationTargetId = 0,
        conver, _historyMessagesCache = {},
        token = "" , _html = "",
        namelist = {
            "group001": "融云群一",
            "group002": "融云群二",
            "group003": "融云群三",
            "kefu114": "客服"
        },
        audio = document.getElementsByTagName("audio")[0],
    //是否开启声音
        hasSound = true,
    
        
        $scope = {};
    var conversationStr = '<li targetType="{0}" targetId="{1}" targetName="{2}"><span class="user_img"><img src={3} onerror="this.src=\'../images/personPhoto.png\'"/><font class="conversation_msg_num {4}">{5}</font></span><span class="conversationInfo"><p style="margin-top: 10px"><font class="user_name">{6}</font><font class="date" >{7}</font></p></span></li>';
    var historyStr = '<div class="xiaoxiti {0} user"><div class="user_img"><img onerror="this.src=\'../images/personPhoto.png\'" src="{1}"/></div><span>{2}</span><div class="msg"><div class="msgArrow"><img src="../images/{3}"> </div><span></span>{4}</div><div messageId="{5}" class="status"></div></div><div class="slice"></div>';
    var friendListStr = '<li targetType="4" targetId="{0}" targetName="{1}"><span class="user_img"><img src="../images/personPhoto.png"/></span> <span class="user_name">{1}</span></li>';
    var discussionStr = '<li targetId="{0}" targetName="{1}" targetType="{2}"><span class="user_img"><img src="../images/user.png"/></span><span class="user_name">{3}</span></li>';
    
    //未读消息数
    $scope.totalunreadcount = 0;
    //绘画列表
    $scope.ConversationList = [];
    //好友列表
    $scope.friendsList = [];
    //会话标题
    $scope.conversationTitle = "";

    //开启关闭声音
    $("#closeVoice").click(function () {
        hasSound = !hasSound;
        this.innerHTML = hasSound ? "开启声音" : "关闭声音";
    });
    //退出
    $(".logOut>a,#close").click(function () {
        $.get("/logout?_=" + Date.now()).done(function () {
            if (RongIMClient.getInstance) {
                RongIMClient.getInstance().disconnect();
            }
        }).always(function () {
            location.href = "login.html";
        })
    });
    

  /*  $.get("/discussion?_=" + Date.now(), function (data) {
        if (data.code == 200) {
            _html = "";
            data.result.forEach(function (item) {
                _html += String.stringFormat(discussionStr, item.id, item.name, RongIMClient.ConversationType.DISCUSSION.valueOf(), item.name);
            });
            $("#discussion").html(_html || "<li>没有加入任何讨论组</li>");
        }
    });
    
    $("#discussionRoom").delegate('li', 'click', function () {
        if (window.RongBrIdge._client.chatroomId == 0) {
            RongIMClient.getInstance().joinChatRoom(this.getAttribute("targetId"), 10, {
                onSuccess: function () {
                    $("#notice").show().css({"color": "green"}).text("加入聊天室成功").delay(2000).fadeOut("slow");
                }, onError: function () {
                    $("#notice").show().css({"color": "green"}).text("加入聊天室失败").delay(2000).fadeOut("slow");
                }
            });
        }
        getHistory(this.getAttribute("targetId"), this.getAttribute("targetName"), this.getAttribute("targetType"));
    });*/
  //登陆人员信息默认值
    owner = {
            id: "",
            portrait: "../images/user_img.jpg",
            name: "张亚涛"
        },
    friend = {
        id: ""
    },
//初始化登陆人员信息
    list = location.search.slice(1).split('&');
    if (list.length > 0) {
    	
        $.each(list, function (i, item) {
            var val = item.split("=");
            friend[val[0]] = decodeURIComponent(val[1]);
        });
    } else {
        //location.href = "login.html";
        //return;
    }
    href = location.href;
    friend_id = href.substr(href.lastIndexOf('/') + 1);
    
    $.get("/rychat_target/" + friend_id + "?_=" + Date.now(), function (data) {
    	console.log('friend:' + data.code);
        if (data.code == 200) {
            $scope.friendsList = data.result;
            $scope.friendsList.forEach(function (item) {
                _html += String.stringFormat(friendListStr, item.id, item.username)
            });
            $("#friendsList").html(_html)
        }
    }, "json");

    $("#friendsList,#conversationlist").delegate('li', 'touch click', function () {
        if (this.parentNode.id == "conversationlist") {
            $("font.conversation_msg_num", this).hide().html("");
        }
        getHistory(this.getAttribute("targetId"), this.getAttribute("targetName"), this.getAttribute("targetType"));
    });
    $("div.listAddr li:lt(4)").click(function () {
        getHistory(this.getAttribute("targetId"), this.getAttribute("targetName"), this.getAttribute("targetType"));
    });
    $("#send").click(function () {
        if (!conver && !currentConversationTargetId) {
            alert("请选中需要聊天的人");
            return;
        }

        var con = $("#mainContent").val().replace(/\[.+?\]/g, function (x) {
            return RongIMClient.Expression.getEmojiObjByEnglishNameOrChineseName(x.slice(1, x.length - 1)).tag || x;
        });
        if (con == "") {
            alert("不允许发送空内容");
            return;
        }
        if (RongIMClient.getInstance().getConversation(RongIMClient.ConversationType.setValue(conver), currentConversationTargetId) === null) {
            RongIMClient.getInstance().createConversation(RongIMClient.ConversationType.setValue(conver), currentConversationTargetId, $("#conversationTitle").text());
        }
        //发送消息
        var content = new RongIMClient.MessageContent(RongIMClient.TextMessage.obtain(myUtil.replaceSymbol(con)));
        RongIMClient.getInstance().sendMessage(RongIMClient.ConversationType.setValue(conver), currentConversationTargetId, content, null, {
            onSuccess: function () {
                console.log("send successfully");
            },
            onError: function (x) {
                var info = '';
                switch (x) {
                    case RongIMClient.callback.ErrorCode.TIMEOUT:
                        info = '超时';
                        break;
                    case RongIMClient.callback.ErrorCode.UNKNOWN_ERROR:
                        info = '未知错误';
                        break;
                    case RongIMClient.SendErrorStatus.REJECTED_BY_BLACKLIST:
                        info = '在黑名单中，无法向对方发送消息';
                        break;
                    case RongIMClient.SendErrorStatus.NOT_IN_DISCUSSION:
                        info = '不在讨论组中';
                        break;
                    case RongIMClient.SendErrorStatus.NOT_IN_GROUP:
                        info = '不在群组中';
                        break;
                    case RongIMClient.SendErrorStatus.NOT_IN_CHATROOM:
                        info = '不在聊天室中';
                        break;
                    default :
                        info = x;
                        break;
                }
                $(".dialog_box div[messageId='" + content.getMessage().getMessageId() + "']").addClass("status_error");
                console.alert('发送失败:' + info);
            }
        });
        addhistoryMessages(content.getMessage());
        initConversationList();
        $("#mainContent").val("");
    });
    
    //初始化SDK
    RongIMClient.init("vnroth0krcaco"); //e0x9wycfx7flq z3v5yqkbv8v30
    
    $.ajax({
        type: "get",
        url: "/rychat_token?_=" + Date.now(),
        dataType: "json"
    }).done(function (data) {
        if (data.code == 200) {
        	
            token = data.result[0];
            owner.id = token.id;
            owner.name = token.username;
            owner.portrait = token.portrait;
            $("img[RCTarget='owner.portrait']").attr("src", token.portrait);
            $('span[RCTarget="owner.name"]').html(data.name);
            //链接融云
            
            RongIMClient.connect(token.token, {
                onSuccess: function (x) {
                    console.log("connected，userid＝" + x);
                },
                onError: function (c) {
                    var info = '';
                    switch (c) {
                        case RongIMClient.callback.ErrorCode.TIMEOUT:
                            info = '超时';
                            break;
                        case RongIMClient.callback.ErrorCode.UNKNOWN_ERROR:
                            info = '未知错误';
                            break;
                        case RongIMClient.ConnectErrorStatus.UNACCEPTABLE_PROTOCOL_VERSION:
                            info = '不可接受的协议版本';
                            break;
                        case RongIMClient.ConnectErrorStatus.IDENTIFIER_REJECTED:
                            info = 'appkey不正确';
                            break;
                        case RongIMClient.ConnectErrorStatus.SERVER_UNAVAILABLE:
                            info = '服务器不可用';
                            break;
                        case RongIMClient.ConnectErrorStatus.TOKEN_INCORRECT:
                            info = 'token无效';
                            break;
                        case RongIMClient.ConnectErrorStatus.NOT_AUTHORIZED:
                            info = '未认证';
                            break;
                        case RongIMClient.ConnectErrorStatus.REDIRECT:
                            info = '重新获取导航';
                            break;
                        case RongIMClient.ConnectErrorStatus.PACKAGE_ERROR:
                            info = '包名错误';
                            break;
                        case RongIMClient.ConnectErrorStatus.APP_BLOCK_OR_DELETE:
                            info = '应用已被封禁或已被删除';
                            break;
                        case RongIMClient.ConnectErrorStatus.BLOCK:
                            info = '用户被封禁';
                            break;
                        case RongIMClient.ConnectErrorStatus.TOKEN_EXPIRE:
                            info = 'token已过期';
                            break;
                        case RongIMClient.ConnectErrorStatus.DEVICE_ERROR:
                            info = '设备号错误';
                            break;
                    }
                    console.alert("失败:" + info);
                }
            });
        } else {
            alert("获取token失败,请重新登录");
            //location.href = "login.html";
        }
    }).fail(function () {
        alert("获取token失败");
        //location.href = "login.html";
    });
    //链接状态监听器
    RongIMClient.setConnectionStatusListener({
        onChanged: function (status) {
            switch (status) {
                //链接成功
                case RongIMClient.ConnectionStatus.CONNECTED:
                    $scope.ConversationList = RongIMClient.getInstance().getConversationList();
                    initConversationList();
                    console.log('链接成功');
                    break;
                //正在链接
                case RongIMClient.ConnectionStatus.CONNECTING:
                    console.log('正在链接');
                    break;
                //重新链接
                case RongIMClient.ConnectionStatus.RECONNECT:
                    console.log('重新链接');
                    break;
                //其他设备登陆
                case RongIMClient.ConnectionStatus.OTHER_DEVICE_LOGIN:
                //连接关闭
                case RongIMClient.ConnectionStatus.CLOSURE:
                //未知错误
                case RongIMClient.ConnectionStatus.UNKNOWN_ERROR:
                //登出
                case RongIMClient.ConnectionStatus.LOGOUT:
                //用户已被封禁
                case RongIMClient.ConnectionStatus.BLOCK:
                    location.href = "/WebIMDemo/login.html";
                    break;
            }
        }
    });
    //接收消息监听器
    RongIMClient.getInstance().setOnReceiveMessageListener({
        onReceived: function (data) {
            if (hasSound) {
                audio.play();
            }
            var tempval = RongIMClient.getInstance().getConversation(data.getConversationType(), data.getTargetId());
            $scope.totalunreadcount = RongIMClient.getInstance().getTotalUnreadCount();
            $("#totalunreadcount").show().html($scope.totalunreadcount);
            if (currentConversationTargetId != data.getTargetId()) {
                if (document.title != "[新消息]融云 Demo - Web SDK") document.title = "[新消息]融云 Demo - Web SDK";
                var person = $scope.friendsList.filter(function (item) {
                    return item.id == data.getTargetId();
                })[0];
                if (person) {
                    tempval.setConversationTitle(person.username);
                } else {
                    if (data.getTargetId() in namelist) {
                        tempval.setConversationTitle(namelist[data.getTargetId()]);
                    } else {
                        RongIMClient.getInstance().getUserInfo(data.getTargetId(), {
                            onSuccess: function (x) {
                                tempval.setConversationTitle(x.getUserName());
                            },
                            onError: function () {
                                tempval.setConversationTitle("陌生人Id：" + data.getTargetId());
                            }
                        });
                    }
                }
                if (!_historyMessagesCache[data.getConversationType().valueOf() + "_" + data.getTargetId()]) _historyMessagesCache[data.getConversationType() + "_" + data.getTargetId()] = [data];
                else _historyMessagesCache[data.getConversationType().valueOf() + "_" + data.getTargetId()].push(data);
            } else {
                if (tempval.getConversationType() == RongIMClient.ConversationType.CHATROOM && tempval.getConversationTitle() == "") {
                    tempval.setConversationTitle("聊天室");
                }
                addhistoryMessages(data);
            }
            initConversationList(data);
        }
    });

    function addhistoryMessages(item) {
        $scope.historyMessages.push(item);
        $(".dialog_box:first").append(String.stringFormat(historyStr, item.getMessageDirection() == 0 ? "other_user" : "self", item.getMessageDirection() == 1 ? owner.portrait : "../images/personPhoto.png", "", item.getMessageDirection() == 0 ? 'white_arrow.png' : 'blue_arrow.png', myUtil.msgType(item), item.getMessageId()));
    }

    function initConversationList() {
        _html = "";
        $scope.ConversationList.forEach(function (item) {
            _html += String.stringFormat(conversationStr, item.getConversationType().valueOf(), item.getTargetId(), item.getConversationTitle(), "../images/personPhoto.png", item.getUnreadMessageCount() == 0 ? "hidden" : "", item.getUnreadMessageCount(), item.getConversationTitle(), new Date(+item.getLatestTime()).toString().split(" ")[4]);
        });
        $("#conversationlist").html(_html);
    }

    //加载历史记录
    function getHistory(id, name, type) {
        if (!window.Modules) //检测websdk是否已经加载完毕
            return;
        conver = type;
        currentConversationTargetId = id;
        if (!_historyMessagesCache[type + "_" + currentConversationTargetId]) _historyMessagesCache[type + "_" + currentConversationTargetId] = [];
        $scope.historyMessages = _historyMessagesCache[type + "_" + currentConversationTargetId];
        $scope.conversationTitle = name;
        var tempval = RongIMClient.getInstance().getConversation(RongIMClient.ConversationType.setValue(conver), currentConversationTargetId)
        $("#conversationTitle").next().remove();
        if (type == RongIMClient.ConversationType.CHATROOM) {    //聊天室
            $("#conversationTitle").after('<span class="setDialog"></span>');
        }
        $("#conversationTitle").html($scope.conversationTitle);
        _html = "";
        $scope.historyMessages.forEach(function (item, i) {
            _html += String.stringFormat(historyStr, item.getMessageDirection() == 0 ? "other_user" : "self", item.getMessageDirection() == 1 ? owner.portrait : "../images/personPhoto.png", "", item.getMessageDirection() == 0 ? 'white_arrow.png' : 'blue_arrow.png', myUtil.msgType(item), item.getMessageId());
        });
        $(".dialog_box:first").html(_html);
        if (tempval === null) {
            return;
        }
        tempval.setUnreadMessageCount(0);
        RongIMClient.getInstance().clearMessagesUnreadStatus(RongIMClient.ConversationType.setValue(type), currentConversationTargetId);
        $scope.totalunreadcount = RongIMClient.getInstance().getTotalUnreadCount();
        if ($scope.totalunreadcount <= 0 && /^\[新消息\]/.test(document.title)) {
            document.title = "融云 Demo - Web SDK";
        }
        $("#totalunreadcount").html($scope.totalunreadcount);
        if ($scope.totalunreadcount == 0) {
            $("#totalunreadcount").hide();
        }
    }
	}
	  };
}(jQuery));

String.stringFormat = function (str) {
    for (var i = 1; i < arguments.length; i++) {
        str = str.replace(new RegExp("\\{" + (i - 1) + "\\}", "g"), arguments[i] != undefined ? arguments[i] : "");
    }
    return str;
};
var myUtil = {
    msgType: function (message) {
        switch (message.getMessageType()) {
            case RongIMClient.MessageType.TextMessage:
                return String.stringFormat('<div class="msgBody">{0}</div>', this.initEmotion(this.symbolReplace(message.getContent())));
            case RongIMClient.MessageType.ImageMessage:
                return String.stringFormat('<div class="msgBody">{0}</div>', "<img class='imgThumbnail' src='data:image/jpg;base64," + message.getContent() + "' bigUrl='" + message.getImageUri() + "'/>");
            case RongIMClient.MessageType.VoiceMessage:
                return String.stringFormat('<div class="msgBody voice">{0}</div><input type="hidden" value="' + message.getContent() + '">', "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + message.getDuration());
            case RongIMClient.MessageType.LocationMessage:
                return String.stringFormat('<div class="msgBody">{0}</div>{1}', "[位置消息]" + message.getPoi(), "<img src='data:image/png;base64," + message.getContent() + "'/>");
        }
    },
    initEmotion: function (str) {
        var a = document.createElement("span");
        return RongIMClient.Expression.retrievalEmoji(str, function (img) {
            a.appendChild(img.img);
            var str = '<span class="RongIMexpression_' + img.englishName + '">' + a.innerHTML + '</span>';
            a.innerHTML = "";
            return str;
        });
    },
    symbolReplace: function (str) {
        if (!str) return '';
        str = str.replace(/&/g, '&amp;');
        str = str.replace(/</g, '&lt;');
        str = str.replace(/>/g, '&gt;');
        str = str.replace(/"/g, '&quot;');
        str = str.replace(/'/g, '&#039;');
        return str;
    },
    replaceSymbol: function (str) {
        if (!str) return '';
        str = str.replace(/&amp;/g, '&');
        str = str.replace(/&lt;/g, '<');
        str = str.replace(/&gt;/g, '>');
        str = str.replace(/&quot;/g, '"');
        str = str.replace(/&#039;/g, "'");
        str = str.replace(/&nbsp;/g, " ");
        return str;
    }
};