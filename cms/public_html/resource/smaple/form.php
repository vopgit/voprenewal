<h2>
    검색 박스
</h2>

<div class="row mb_25">
                <div class="col_4 pr_10">
                    <div class="sel_box">
                        <select name="" id="" class="sel sel_md fm_full ">
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
<br>
<br>
<br>

<h2>색상 태그</h2>
<div class="row">

    <div class="col_7">
        <div class="flex ai_c jc_sb in_multy_radio j_right mt_10">

            <label for="tagColorR" class="fm_rd">
                <input type="radio" name="tag_color" id="tagColorR"><span class="_icon"></span>
                <span class="rd_color_box bc_1">
                    <i class="text_hide">빨간색</i>
                </span>
            </label>
            <label for="tagColorB" class="fm_rd">
                <input type="radio" name="tag_color" id="tagColorB"><span class="_icon"></span>
                <span class="rd_color_box bc_2">
                    <i class="text_hide">파란색</i>
                </span>
            </label>
            <label for="tagColorG" class="fm_rd">
                <input type="radio" name="tag_color" id="tagColorG"><span class="_icon"></span>
                <span class="rd_color_box bc_3">
                    <i class="text_hide">초록색</i>
                </span>
            </label>
            <label for="tagColorBL" class="fm_rd">
                <input type="radio" name="tag_color" id="tagColorBL"><span class="_icon"></span>
                <span class="rd_color_box bc_4">
                    <i class="text_hide">검은색</i>
                </span>
            </label>
        </div>
    </div>
</div>
<br>
<br>
<br>

<h2>관련기사</h2>

<ul class="move_inp_box mt_10">
    <li class="row lst_item">
        <div class="col_19 inp_box row">
            <div class="col_18">
                <input type="text" value="1" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full">
            </div>
            <div class="col_6">
                <input type="text" value="a" placeholder="시리얼넘버" readonly="" class="inp inp_sm fm_full read_only">
            </div>
        </div>
        <div class="col_5 cnt_box pl_10 flex ai_c">
            <div class="move_floor">
                <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
            </div>
            <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
            <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
        </div>
    </li>
    <li class="row lst_item">
        <div class="col_19 inp_box row">
            <div class="col_18">
                <input type="text" placeholder="노출제목 (미 입력 시 기사 원 제목을 사용합니다.)" class="inp inp_sm fm_full">
            </div>
            <div class="col_6">
                <input type="text" placeholder="시리얼넘버" readonly="" class="inp inp_sm fm_full read_only">
            </div>
        </div>
        <div class="col_5 cnt_box pl_10 flex ai_c">
            <div class="move_floor">
                <button name="" id="" class="btn act_up arrow" type="button"> <i class="iconFt_arrow_up"></i></button>
                <button name="" id="" class="btn act_down arrow" type="button"> <i class="iconFt_arrow_down"></i></button>
            </div>
            <button onclick="$(this).closest('.lst_item').remove();" name="" id="" class="btn btn_c14 btn_sm remove" type="button">삭제</button>
            <button onclick="createNextNode()" name="" id="" class="btn btn_sm create" type="button">추가</button>
        </div>
    </li>
</ul>

<br>
<br>
<br>

<h2>radio and checkbox</h2>

<label class="fm_rd ">
    <input type="radio" title="">
        아니요
</label>

<label class="fm_ch ">
    <input type="checkbox" title="">
        아니요
</label>

<br>
<br>
<br>
    <h2>
    select
    </h2>
    <hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<br>
<br>
<p>
    type1
</p>
<br>
<select name="" id="" class="sel">
    <option value="">sample select1</option>
    <option value="">sample select2</option>
    <option value="">sample select3</option>
    <option value="">sample select4</option>
    <option value="">sample select5</option>
</select>
<select name="" id="" class="sel fm_full">
    <option value="">sample select1</option>
    <option value="">sample select2</option>
    <option value="">sample select3</option>
    <option value="">sample select4</option>
    <option value="">sample select5</option>
</select>
<br>
<p>
    type2
</p>
<br>
<div class="row">
    <select name="" id="" class="sel sel_sm">
        <option value="">sample1</option>
        <option value="">sample2</option>
        <option value="">sample3</option>
        <option value="">sample4</option>
        <option value="">sample5</option>
    </select>

    <select name="" id="" class="sel sel_sm border_color">
        <option value="">sample1</option>
        <option value="">sample2</option>
        <option value="">sample3</option>
        <option value="">sample4</option>
        <option value="">sample5</option>
    </select>

    <select name="" id="" class="sel sel_md border_color">
        <option value="">sample1</option>
        <option value="">sample2</option>
        <option value="">sample3</option>
        <option value="">sample4</option>
        <option value="">sample5</option>
    </select>
</div>


<br>


<h2>input</h2>
    <hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

    <input type="text" class="inp" placeholder="검색어를 입력해주세요.">
    <input type="text" class="inp inp_sm" placeholder="검색어를 입력해주세요.">
    <input type="text" class="inp fm_full" placeholder="검색어를 입력해주세요.">

    <input type="text" class="inp fm_full read_only" placeholder="비활성화" readonly>

<h2>input 박스 같은 .. 텍슽 박스</h2>
<div class="txt_inp">
    <p>기자</p>
</div>
<br><br><br>
<h2>file</h2>
    <hr style="   border: dashed;   color: #ddd;    border-width: 1px;">

    <div class="file_box fm_full">
        <div class="file_con ">
            <input type="file" multiple="multiple" >
            <button class="btn file">파일선택</button>
            <span class="file_name "></span>
        </div>
    </div>

    <div class="file_box ">
        <div class="file_con">
            <input type="file" multiple="multiple" >
            <button class="btn file">파일선택</button>
            <span class="file_name "></span>
        </div>
    </div>


    <div class="file_box create ">
        <div class="file_con">
            <input type="file" multiple="multiple" >
            <button class="btn file">파일선택</button>
            <span class="file_name "></span>
        </div>
    </div>





<br>
<br>
<br>
