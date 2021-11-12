<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>칼럼명 관리</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">

                    <div class="pop_scroll">
                        <div class="table_box horizontal t_center border_tb2 mb_5">
                            <table>
                                <colgroup>
                                    <col width="14%">
                                    <col width="86%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>칼럼명</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for($i=1; $i<10; $i++){

                                   
                                    ?>
                                    <tr>
                                        <td class="act_tc3">100</td>
                                        <td class="act_tc3">
                                            <a href="javascript:void(0);">
                                                <div class="table_ellip">
                                                    <span> 기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들 이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들</span>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>


                                    <?php  }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class=" mt_30 t_center">
                        <a class="btn_md btn_c2 ">저장</a>
                        
                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>

<script>
     $('.table_box').find('.act_tc3').click(function(){
        $('.act_tc3').removeClass('on');
        $(this).addClass('on');
        $(this).siblings('td').addClass('on');
    })
  


</script>



</body>
</html>
