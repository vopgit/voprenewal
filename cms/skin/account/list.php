<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <div class="row jc_sb mb_20">
            <h3>계정 관리</h3>
        </div>
        <form action="">
            <div class="row mb_25">
                <div class="col_4 pr_10">
                    <div class="sel_box">
                        <select name="" id="" class="sel sel_md fm_full placeholder __customUi">
                            <option value="">회원종류</option>
                            <option value="">sample select2</option>
                            <option value="">sample select3</option>
                            <option value="">sample select4</option>
                            <option value="">sample select5</option>
                        </select>
                    </div>
                </div>
                <div class="col_5 pr_10">
                    <input type="text" class="inp fm_full" placeholder="이름">
                </div>
                <div class="col_8 pr_10">
                    <input type="text" class="inp fm_full" placeholder="이메일" >
                </div>
                <div class="col_7 ">
                    <div class="row">
                        <div class="col_19 t_right">
                            <input type="text" class="inp fm_full" placeholder="작성자" >
                        </div>
                        <div class="col_5 t_right">
                            <a href="" class="btn btn_c7 btn_sm search">검색</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <form action="">
            <div class="table_box horizontal">                
                <table class="t_center">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="7%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="7%">
                    <col width="10%">
                </colgroup>
                    <thead >
                        <tr>
                            <th >No.</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>이메일</th>
                            <th>일반전화</th>
                            <th>휴대전화</th>
                            <th>회원종류</th>
                            <th >가입일시</th>
                        </tr>
                    </thead>
                    <tbody >
                    <?php
                        $ftColor = array('대기중','작성중','발행중','삭제됨');

                        foreach($ftColor as $key => $value){
                     ?>
                        <tr>
                            <td>100</td>
                            <td>abcd123</td>
                            <td><a href="">김그림</a></td>
                            <td> abc@vop.co.kr</td>
                            <td>070-1234-5678</td>
                            <td> 070-1234-5678</td>
                            <td >기자</td>
                            <td >2021/07/19 18:32:31</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <div class="page_wrap pt_30 pb_25">
                    <?php include $_SERVER["DOCUMENT_ROOT"].'/include/page.php'; ?>
                </div>
            </div>
        </form>

        <div class="t_right mt_25">
            <a class="btn_lg btn_cg"> 등록하기</a>
        </div>
    </div>



</div>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
