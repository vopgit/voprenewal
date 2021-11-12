<?php include _ROOT.'/include/head.php'; ?>
<!-- header -->
    <div class="header  ">
            <div class="row">
                <div class="col_17">
                    <div class="row left">
                        <h1 class="logo">
                            <a href="/">
                                <img src="/resource/images/logo.png" alt="민중의소리">
                            </a>
                        </h1>
                        <ul class="gnb">
							<?php
							//$_menu_code 는 각 페이지별 최상단에 정의해 주세요
							if(!isset($_menu_code)) $_menu_code = "0101";

							$_menu = $_config['_menu'];
							
							for($i=0; $i<count($_menu); $i++) {
								
								if(in_array($_SESSION['s_adm']['role'], $_menu[$i]['permit'])){
									$menu1_on = (substr($_menu_code, 0, 2) == $_menu[$i]['code']) ? "on" : "";
									?>
									<li class="depth_1 <?=$menu1_on?>">
										<a href="<?=$_menu[$i]['url']?>"><?=$_menu[$i]['title']?></a>
										<?php if(count($_menu[$i]['depth2']) > 0){ ?>
											<div class="depth_2 box">
												<ul class="depth_2 _wrap">
													<?php
													for($j=0; $j<count($_menu[$i]['depth2']); $j++) {
														if(in_array($_SESSION['s_adm']['role'], $_menu[$i]['depth2'][$j]['permit'])){
															$menu2_on = ($_menu_code == $_menu[$i]['depth2'][$j]['code']) ? "on" : "";
															?>
															<li class="<?=$menu2_on?>"><a href="<?=$_menu[$i]['depth2'][$j]['url']?>"><span><?=$_menu[$i]['depth2'][$j]['title']?></span></a></li>
															<?php
														}
													}
													?>
												</ul>
											</div>
										<?php } ?>
									</li>
								<?php
								}
							}
							
							?>
                        </ul>
                    </div>

                </div>

				          <div class="col_7">
                    <div class="row right">
                        <span class="name_txt">
                            <?=$_SESSION['s_adm']['name']?>님 환영합니다
                        </span>
                        <ul class="link_info link_">
                            <li>
                                <a href="/member/logout">로그아웃</a>
                            </li>
                            <li>
                                <a href="">회원정보</a>
                            </li>
                        </ul>

                        <ul class="link_call link_">
                            <li>
                                <a href="">VOP</a>
                            </li>
                            <li>
                                <a href="/">ADMIN</a>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
<!-- header -->
