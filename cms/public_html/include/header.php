<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<!-- header -->
    <div class="header  ">
            <div class="row">
                <div class="col_17 gnb_area">
                    <div class="row left">
                        <h1 class="logo">
                            <a href="/">
                                <img src="/resource/images/logo.png" alt="민중의소리">
                            </a>
                        </h1>
                        <ul class="gnb">
							<?php
							//메뉴정의 - /core/common/config.php
							//$_menu_code 는 각 페이지별 최상단에 정의
							for($i=0; $i<count($_menu); $i++) {
								if(($_SERVER["REMOTE_ADDR"] == "121.190.224.191")||($_SERVER["REMOTE_ADDR"] == "115.68.226.250")){
									//관리자 계정 관리용 메뉴 보이기...

									if(in_array($_SESSION['_admin']['role'], $_menu[$i]['permit'])){
										$menu1_on = (substr($_menu_code, 0, 2) == $_menu[$i]['code']) ? "on" : "";
										$target_action = ($_menu[$i]['target'] != '') ? 'target="'.$_menu[$i]['target'].'"' : '';
										?>
										<li class="depth_1 <?=$menu1_on?>">
											<a href="<?=$_menu[$i]['url']?>" <?=$target_action?>><?=$_menu[$i]['title']?></a>
											<?php if(count($_menu[$i]['depth2']) > 0){ ?>
												<div class="depth_2 box">
													<ul class="depth_2 _wrap">
														<?php
														for($j=0; $j<count($_menu[$i]['depth2']); $j++) {
															if(in_array($_SESSION['_admin']['role'], $_menu[$i]['depth2'][$j]['permit'])){
																$menu2_on = ($_menu_code == $_menu[$i]['depth2'][$j]['code']) ? "on" : "";
																$target2_action = ($_menu[$i]['depth2'][$j]['target'] != '') ? 'target="'.$_menu[$i]['depth2'][$j]['target'].'"' : '';
																?>
																<li class="<?=$menu2_on?>"><a href="<?=$_menu[$i]['depth2'][$j]['url']?>" <?=$target2_action?>><span><?=$_menu[$i]['depth2'][$j]['title']?></span></a></li>
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
								}else{
									if($_menu[$i]['code'] != "10"){

										if(in_array($_SESSION['_admin']['role'], $_menu[$i]['permit'])){
											$menu1_on = (substr($_menu_code, 0, 2) == $_menu[$i]['code']) ? "on" : "";
											$target_action = ($_menu[$i]['target'] != '') ? 'target="'.$_menu[$i]['target'].'"' : '';
											?>
											<li class="depth_1 <?=$menu1_on?>">
												<a href="<?=$_menu[$i]['url']?>" <?=$target_action?>><?=$_menu[$i]['title']?></a>
												<?php if(count($_menu[$i]['depth2']) > 0){ ?>
													<div class="depth_2 box">
														<ul class="depth_2 _wrap">
															<?php
															for($j=0; $j<count($_menu[$i]['depth2']); $j++) {
																if(in_array($_SESSION['_admin']['role'], $_menu[$i]['depth2'][$j]['permit'])){
																	$menu2_on = ($_menu_code == $_menu[$i]['depth2'][$j]['code']) ? "on" : "";
																	$target2_action = ($_menu[$i]['depth2'][$j]['target'] != '') ? 'target="'.$_menu[$i]['depth2'][$j]['target'].'"' : '';
																	?>
																	<li class="<?=$menu2_on?>"><a href="<?=$_menu[$i]['depth2'][$j]['url']?>" <?=$target2_action?>><span><?=$_menu[$i]['depth2'][$j]['title']?></span></a></li>
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
								}
							}
							?>
                        </ul>
                    </div>

                </div>

				<div class="col_7 etc_area">
                    <div class="row right">
                        <span class="name_txt">
                            <?=$_SESSION['_admin']['name']?>님 환영합니다
                        </span>
                        <ul class="link_info link_">
                            <li>
                                <a href="/logout">로그아웃</a>
                            </li>
                            <li>
                                <a href="/member/me">회원정보</a>
                            </li>
                        </ul>

                        <ul class="link_call link_">
                            <li>
                                <a href="https://www.vop.co.kr/" target="_blank">VOP</a>
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
