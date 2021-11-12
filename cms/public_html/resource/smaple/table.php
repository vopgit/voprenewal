

<h3> 테이블 가로 (table_box horizontal) scroll</h3>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<br>


<div class="table_box horizontal t_center scroll" data-scroll-width="2000">

    <table>
        <colgroup>
            <col data-col-width="20" />
            <col data-col-width="20" />
            <col data-col-width="20"/>
            <col data-col-width="20"/>
            <col data-col-width="20" />
        </colgroup>
        <thead>
            <tr>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<=3; $i++){?>
            <tr>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<br>
<br>

<h3> 테이블 가로 Hover (table_box act_hov)</h3>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<div class="table_box act_hov t_center">
    <table>
        <thead>
            <tr>
                <th>Sample</th>
                <th>Sample</th>
                <th>Sample</th>
                <th>Sample</th>
                <th>Sample</th>
                <th>Sample</th>
            </tr>
        </thead>
        <tbody>
            <? for($i = 0; $i < 3; $i++) { ?>
            <tr>
                <td>Sample</th>
                <td>Sample</th>
                <td>Sample</th>
                <td>Sample</th>
                <td>Sample</th>
                <td>Sample</th>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<br>
<br>

<h3> 테이블 가로 (table_box horizontal)</h3>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<br>


<div class="table_box horizontal t_center">

    <table>
        <colgroup>
            <col data-col-width="20" />
            <col data-col-width="20" />
            <col data-col-width="20"/>
            <col data-col-width="20"/>
            <col data-col-width="20" />
        </colgroup>
        <thead>
            <tr>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
                <th>sample</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<=3; $i++){?>
            <tr>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
                <td>smaple</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<br>
<br>
<h3> 테이블 세로 (table_box vertica)</h3>
<hr style="   border: dashed;   color: #ddd;    border-width: 1px;">
<br>


<div class="table_box vertical t_left">
    <table>
    <colgroup>
        <col width="20%">
        <col width="80%">
    </colgroup>
        <tbody>
            <?php for($i=0; $i<=3; $i++){?>
            <tr>
                <th>smaple</th>
                <td>
                    <div class="table_ellip fs_14">
                        <span> 기사 제목 100이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들 이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들이 들어갑니다. 기사 제목 100이 들어갑니다. 기사 제목이 들</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<hr>
