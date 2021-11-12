<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap wrap1300">
            <div class=" popup_con ">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>사진미리보기</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>
                <div class="popup_contents ">

                <div class="table_box vertical t_left">
                    <table>
                    <colgroup>
                        <col width="16.666%">
                        <col width="16.666%">
                        <col width="16.666%">
                        <col width="16.666%">
                    </colgroup>
                        <tbody>
                            <tr>
                                <th>제목</th>
                                <td  colspan="5">미리보기 이미지 입니다.</td>
                            </tr>

                            <tr>
                                <th>설명</th>
                                <td  colspan="5">미리보기 이미지 설명 입니다.</td>
                            </tr>

                            <tr>
                                <th>입력</th>
                                <td>임시기자</td>

                                <th>저작권</th>
                                <td>기타</td>

                                <th>크기</th>
                                <td>1616*2400</td>
                            </tr>

                            <tr>
                                <td  colspan="6">
                                    <img src="/resource/images/ranking.jpg" style="max-width: 100%;" alt="미리보기 이미지 입니다.">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
  

                   


                
                </div>

            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>


<script>

   




$('.btn_step2').click(function(){
    $('.btn_step2').closest('.step_1').slideUp();
    $('.step_2').slideDown(); 
 });
 $('.btn_stepBack').click(function(){
    $('.step_2').slideUp(); 
    $('.step_1').slideDown();
});




</script>