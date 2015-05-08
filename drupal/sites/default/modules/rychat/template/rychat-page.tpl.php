<div class="wrap">
    <div class="left">
        <div class="dialog_header header">
                    <span class="owner_image">
                        <img RCTarget="owner.portrait" onerror="this.src='<?php print $settings['pre_path']?>/static/images/personPhoto.png'"/>
                    </span>
                    <span class="owner_name" RCTarget="owner.name">test
                    </span>
                    <span class="setting">
                        <a href="javascript:void(0)" id="setting"><label></label> </a>
                    </span>
        </div>
        <div class="phone_dialog_header header">
                    <span class="logOut">
                        <a href="javascript:void(0)" ng-click="logout()" title="退出"></a>
                    </span>
                    <span class="addrBtnBack btnBack">
                        <a href="javascript:void(0)" title="返回">＜ 返回</a>
                    </span>
            融云
                    <span class="addrBtn">
                        <a href="javascript:void(0)" title="联系人"></a>
                    </span>
        </div>
        <div class="settingView">
            <!--<span class="volSetting"><span class="hover" id="createDiscussion">创建讨论组</span></span>-->
            <hr>
            <span class="volSetting"><span class="hover" id="closeVoice">关闭声音</span></span>
            <hr>
            <span  class="logOut"><span id="close" class="hover">退出登录</span></span>
        </div>
        <div class="listOperatorContent">
            <div class="conversationBtn">
                <a href="javascript:void(0)" title="聊天"><span><font id="totalunreadcount" class="msgNum" style="display:none;"></font></span></a>
            </div>
            <div class="cutOffRule" style="width: 2px;"></div>
            <div class="addrBtn selected">
                <a href="javascript:void(0)" title="通讯录"><span></span></a>
            </div>
        </div>
        <div class="listConversation list" style="display:none ;">
            <ul id="conversationlist">

            </ul>
        </div>
        <div class="listAddr list" style="">
            
            <div class="nameInitials">客服</div>
            <ul>
                <li targetId="rong.io.kefu.service112" targetName="融云客服" targetType="1">
                    <span class="user_img"><img src="<?php print $settings['pre_path']?>/static/images/user.png"/></span>
                    <span class="user_name">融云客服</span>
                </li>
            </ul>
            <div class="nameInitials">聊天室</div>
            <ul id="discussionRoom">
                <li targetId="tr002" targetName="聊天室" targetType="0">
                    <span class="user_img"><img src="<?php print $settings['pre_path']?>/static/images/user.png"/></span>
                    <span class="user_name">聊天室</span>
                </li>
            </ul>
            <div class="nameInitials">讨论组</div>
            <ul id="discussion">

            </ul>
            <div class="nameInitials">好友列表</div>
            <ul id="friendsList">

            </ul>
        </div>
    </div>
    <div class="right_box" style="display:none ;">
        <div class="right"style="position: relative">
            <div class="dialog_box_header header" >
                <a href="javascript:void(0)" class="btnBack">＜ 返回 <label></label></a>
                <span id="conversationTitle"></span>
            </div>
            <div id="notice" style="z-index: 1000;display: none;width: 100%;height: 30px;background: #ffffff;position: absolute;border: solid 1px #ccc;text-align: center;line-height: 30px;">

            </div>
            <div class="dialog_box">

            </div>
            <div class="msg_box">
                <div class="features">
                            <span class="expression">
                                <a href="javascript:void(0)" id="RongIMexpression" title="表情"></a>
                            </span>
                </div>
                <div class="input_box">
                    <div class="button_box">
                        <div id="expresscontent"></div>
                        <span><button id="send">发送</button></span>
                        <span><font>Ctrl + Enter</font></span>
                    </div>
                    <div class="text_box">
                        <textarea class="textarea" id="mainContent" style="resize: none"></textarea>
                    </div>
                </div>
                <div class="RongIMexpressionWrap"></div>
            </div>
        </div>
    </div>
</div>