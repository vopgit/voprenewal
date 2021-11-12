<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
    .popup_wrap {
        overflow-y: visible;
        height: 43.75em;
    }
    .popup_con{
        padding-top: 10rem;
        max-height: 100%;
        position: relative;
    }
    .popup_contents{
        height: 33.75em;
        overflow-y: auto;
        padding: 1.25rem;
    }
    .tit_box{
        top:0;
        position: absolute;
    }
    .serial_wrap {
        margin-right: -1.2rem;
    }
    .serialnum_wrap{
        top:4.25rem;
        padding: 0 1.25rem;
        position: absolute;
        background: #fff;
    }

</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>기사검색</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="serialnum_wrap">
                    <form action="">
                        <div class="table_box vertical t_center border_t2 serialnum">
                            <table>
                                <colgroup>
                                    <col width="20%">
                                    <col width="80%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>시리얼 <br />넘버</th>
                                        <td>

                                                <ul class="serial_wrap t_left">
                                                    <?php for ($i=1; $i < 12; $i++) { ?>
                                                        <li class="number_item">
                                                            <div class="number_btn ">
                                                                <span class="txt"><?php echo $i?>A0000158495</span>
                                                                <button class="num_close"><i class="iconFt_round_close"></i></button>
                                                            </div>
                                                        </li>
                                                    <?php }?>
                                                </ul>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="popup_contents">



                    <div class="row mb_20">
                        <div class="col_7 t_right">
                            <input type="text" class="inp fm_full" placeholder="시리얼 넘버">
                        </div>
                        <div class="col_13 t_right pl_10">
                            <input type="text" class="inp fm_full" placeholder="기사제목">
                        </div>
                        <div class="col_4 t_right">
                            <a href="" class="btn btn_c7 btn_sm search">검색</a>
                        </div>
                    </div>



                    <div class="pop_pageing">
                        <div class="table_box horizontal t_center border_t2">
                            <table>
                                <colgroup>
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="60%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>시리얼 넘버</th>
                                        <th>기사제목</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  for($i=1; $i<11; $i++){ ?>
                                    <tr>
                                        <td class="act_tc3">
                                            <?php echo $i?>
                                        </td>
                                        <td  class="act_tc3">A00001584957</td>
                                        <td  class="act_tc3">
                                            <a href="javascript:void(0);">
                                                <div class="table_ellip t_left">
                                                    <span> 기사 제목이 들이 들어갑니다.</span>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>


                                    <?php  }?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="popup_pageing">
                        <div class="page_wrap pt_30 pb_25">
                         <?php include $_SERVER["DOCUMENT_ROOT"].'/include/page.php'; ?>

                        </div>
                    </div>



                    <script>
                       $(function (){
                        serial_drop(".serial_wrap");
                       })
                    </script>

                    <div class="mt_30 t_center">
                        <a class="btn_md btn_c2 ">확인</a>
                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>




</body>
</html>
