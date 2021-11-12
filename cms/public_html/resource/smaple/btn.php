
<h2>
    시리얼 넘버 박스
 </h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

<div class="row">
<div class="col_10">
    <ul class="serial_wrap t_left">
        <?php for ($i=1; $i < 3; $i++) { ?>
            <li class="number_item">
                <div class="number_btn ">
                    <span class="txt"><?php echo $i?>A0000158495</span>
                    <button class="num_close"><i class="iconFt_round_close"></i></button>
                </div>
            </li>
        <?php }?>
    </ul>
</div>

</div>

<script>
    $(function(){
        serial_drop('.serial_wrap');
    })
</script>
<br><br><br>
<h2>
    button default color
 </h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

<div class="btn_box wp_5">
<a href="" class="btn btn_line_c4">기사수정</a>
<a href="" class="btn btn_line_c4">사진보류</a>
<a href="" class="btn btn_line_c8">수정</a>
<a href="" class="btn btn_line_c8">사진수정</a>
<a href="" class="btn btn_line_c8">리뷰수정</a>
<a href="" class="btn btn_line_c8">노출수정</a>
<a href="" class="btn btn_line_c9">편집완료</a>
<a href="" class="btn btn_line_c11">편집대기로</a>
<a href="" class="btn btn_line_c10">스택틱 만들기</a>
<a href="" class="btn btn_line_c12">트위터 전송</a>
<a href="" class="btn btn_line_c13">페북 노출 정보</a>

<a href="" class="btn btn_line_c5 report">송고하기</a>
<a href="" class="btn btn_c6 btn_sm">보기</a>
<a href="" class="btn btn_c14 btn_sm">찾기</a>
<a href="" class="btn btn_c14 btn_sm">삭제</a>
<a href="" class="btn  btn_sm">추가</a>

<a href="" class="btn btn_c7 btn_sm search">검색</a>
</div>
<br><br><br>

<?php

$color = array('cg','cb','cd');

?>

<h2>
    더 보기 링크
 </h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

    <a href="" class="more_link">
        <span>더 많이 보기</span>
        <i class="iconFt_arrow_right"></i>
    </a>
<br>
<br>
<br>
<br>

<h2>
 테블 안에 들어가는 버튼 라인
 </h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<div class="btn_box wp_5">
<a href="" class="btn ">버튼기본</a>
    <?php
        foreach($color as $key => $value){
            echo '<a href="" class="btn btn_line_'.$value.'">btn_line_'.$value.'</a>';
        }
    ?>

    <?php for($i=1; $i<=14; $i++){?>

        <button class="btn btn_line_c<?php echo $i?>" type="button ">
            btn_line_c<?php echo $i?>
        </button>

    <?php } ?>
</div>
<br>
<br>
<br>
<br>


<h2>테이블 안에 들어가는  버튼 full color</h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<div class="btn_box wp_5">

    <?php
        foreach($color as $key => $value){
            echo '<a href="" class="btn btn_'.$value.'">btn_'.$value.'</a>';
        }
    ?>
    <?php for($i=1; $i<=14; $i++){?>
        <a href="" class="btn btn_c<?php echo $i?>">
        btn_c<?php echo $i?>
        </a>
    <?php } ?>
</div>

<br>
<br>
<br>


<h2>
    편집 , 등록, 선택, 완료 등 버튼
</h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<div class="btn_box wp_5">
    <button class="btn_lg btn_c2"> 수정 완료</button>
    <button class="btn_lg btn_c2"> 전체 편집 완료</button>
    <button class="btn_lg btn_c7"> 선택 편집 완료</button>
    <button class="btn_lg btn_cg"> 등록하기</button>
    <button class="btn_lg btn "> 목록으로</button>
    <button class="btn_lg btn btn_line_c14">  선택삭제</button>
    <button class="btn_lg btn btn_line_c14"> 계정삭제</button>
    <button class="btn_md btn_c2">등록</button>
    <button type="button" class="btn_lg btn_c2 btn_full"><span>기사 입력 완료</span></button>
</div>
<br>
<br>
<br>


<h2>
    버튼 이벤트2
</h2>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

<div class="edit_info_box_wrap">
    <button class="btn btn_c6" type="button" onclick="$('.edit_info_box').hide(); $(this).next().show();">
        <span>보기</span>
    </button>
    <div class="edit_info_box">
        <ul>
            <li><b>편집일시</b><span>2021-07-20 11:51:40(1차)</span></li>
            <li><b>대체명의</b><span>조영기</span></li>
            <li><b>최근송고</b><span>2021-07-20 12:00:00</span></li>
        </ul>
        <button class="edit_info_box_close" type="button"  onclick="$(this).closest('.edit_info_box').hide();"><span class="text_hide">닫기</span></button>
    </div>
</div>


<br>
<br>
<br>