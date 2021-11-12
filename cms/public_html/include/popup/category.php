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
                    <span>카테고리 관리</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">
                    <ul class="tab_box mb_20">
                        <li><a href="#">네이버</a></li>
                        <li  class="on"><a href="#">다음</a></li>
                    </ul>

                    <div class="row mb_20">
                        <div class="col_24 t_right tc_3 mb_5">
                            <p class="fs_13">* 내용을 변경하신 후 꼭 저장 버튼을 클릭해 주세요.</p>
                        </div>
                        <div class="col_20 t_right">
                            <input type="text" class="inp fm_full" placeholder="작성자">
                        </div>
                        <div class="col_4 t_right">
                            <a href="" class="btn btn_c7 btn_sm search">검색</a>
                        </div>
                    </div>
                    <div class="pop_scroll">
                        <div class="table_box horizontal t_center border_tb2 mb_5">
                            <table>
                                <colgroup>
                                    <col width="7%">
                                    <col width="13%">
                                    <col width="80%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>
                                        <label class="fm_ch "  >
                                            <input type="checkbox" class="all_ch" >
                                        </label>
                                        </th>
                                        <th>No.</th>
                                        <th>칼럼명</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for($i=1; $i<5; $i++){

                                   
                                    ?>
                                    <tr>
                                        <td class="act_tc3">
                                            <label class="fm_ch ">
                                                <input type="checkbox" name="pick_ch" class="pick_ch">
                                            </label>
                                        </td>
                                        <td class="act_tc3">100</td>
                                        <td class="act_tc3">
                                            <div class="row">
                                                <div class="col_20 t_left">
                                                   사회
                                                </div>
                                                <div class="col_4 t_right ">
                                                    <div class="arrow_btn row ai_c jc_fe t_right">
                                                        <button class="btn act_down arrow"> <i class="iconFt_arrow_down"></i></button>
                                                        <button class="btn act_up   arrow"> <i class="iconFt_arrow_up"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php  }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class=" mt_30 row">
                        <div class="col_10">
                            <a class="btn_md btn ">선택 삭제</a>
                        </div>
                        <div class="col_5">
                            <a class="btn_md btn_c2 ">저장</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>

<script>
    $(function(){
        act_checkBox('.all_ch','.pick_ch');
    });

    function act_checkBox(all_ch,name){
        var $all_ch = $(all_ch);
        var $pick_ch =$(name);

        $all_ch.change(function (){
            $(this).is(':checked') ?  $pick_ch.prop('checked',true) :  $pick_ch.prop('checked', false);
        })

        $pick_ch.change(function (){
           var chLangth = $pick_ch.length;
           var pickLangth = $(name+':checked').length;
           chLangth == pickLangth  ?  $all_ch.prop('checked',true) :  $all_ch.prop('checked', false);
        })
    }

  


</script>


</body>
</html>