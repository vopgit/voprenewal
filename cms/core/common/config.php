<?php
if(!defined('_HOME_TITLE')) exit;

//기본 SEO 정의
$_site = array(
			'title' => '민중의소리',
			'description' => '민중의소리',
			'keywords' => '민중의소리',
			'image' => 'https://www.vop.co.kr/logo.png',
			'url' => _DOMAIN.$_SERVER['REQUEST_URI']
		  );

//가입불가 계정ID
$_not_allow_id = array('admin', 'administrator', 'master', 'webmaster', 'postmaster', 'manager', 'root', 'vop', 'editor', 'reporter', 'system');

//회원 종류 정의
$_member_type = array(
					'reporter'=>'기자',
					'editor'=>'편집자'
				);

//기사 상태 타이틀 및 색상 정의
$_post_status = array(
					 'tempstored' => array('title'=>'작성중', 'color'=> 'sta_c2'),
					 'standby' => array('title'=>'대기중', 'color'=> 'sta_c1'),
					 'published' => array('title'=>'발행중', 'color'=> 'sta_c3'),
					 'reserved1' => array('title'=>'보류중', 'color'=> 'sta_c5'),
					 'reserved2' => array('title'=>'보류중', 'color'=> 'sta_c5'),
					 'deleted' => array('title'=>'삭제됨', 'color'=> 'sta_c4')
				 );

//메뉴 정의
$_menu = array(
				array(
					'code' => '01',
					'title' => '기사입력',
					'url' => '#',
					'permit' => array('editor', 'reporter'),
					'depth2' => array(
									array('code' => '0101', 'title'=>'기사입력', 'url'=>'/contents/input/article', 'permit'=>array('editor', 'reporter')),
									array('code' => '0102', 'title'=>'사설', 'url'=>'/contents/input/leading', 'permit'=>array('editor', 'reporter')),
									array('code' => '0103', 'title'=>'칼럼', 'url'=>'/contents/input/column', 'permit'=>array('editor', 'reporter')),
									array('code' => '0104', 'title'=>'만평', 'url'=>'/contents/input/cartoon', 'permit'=>array('editor', 'reporter')),
									array('code' => '0105', 'title'=>'민소픽', 'url'=>'/contents/input/minsopick', 'permit'=>array('editor', 'reporter')),
									array('code' => '0106', 'title'=>'페북', 'url'=>'/contents/input/fb', 'permit'=>array('editor', 'reporter')),
									array('code' => '0107', 'title'=>'지자체 기사', 'url'=>'/contents/input/local', 'permit'=>array('editor', 'reporter'))
							   )
					),

				array(
					'code' => '02',
					'title' => '원소스 관리',
					'url' => '#',
					'permit' => array('editor', 'reporter'),
					'depth2' => array(
									array('code' => '0201', 'title'=>'원소스 입력', 'url'=>'/osmu/input', 'permit'=>array('editor', 'reporter')),
									array('code' => '0202', 'title'=>'발행된 원소스', 'url'=>'/osmu/list', 'permit'=>array('editor', 'reporter'))
							   )
					),

				array(
					'code' => '03',
					'title' => '사진 관리',
					'url' => '#',
					'permit' => array('editor', 'reporter'),
					'depth2' => array(
									array('code' => '0301', 'title'=>'사진 입력', 'url'=>'/photo/input', 'permit'=>array('editor', 'reporter')),
									array('code' => '0302', 'title'=>'발행된 사진', 'url'=>'/photo/list', 'permit'=>array('editor', 'reporter')),
									array('code' => '0303', 'title'=>'보류된 사진', 'url'=>'/photo/hold', 'permit'=>array('editor', 'reporter'))
							   )
					),

				array(
					'code' => '04',
					'title' => '리뷰 관리',
					'url' => '#',
					'permit' => array('editor', 'reporter'),
					'depth2' => array(
									array('code' => '0401', 'title'=>'리뷰 입력', 'url'=>'/review/input', 'permit'=>array('editor', 'reporter')),
									array('code' => '0402', 'title'=>'리뷰 편집 대기', 'url'=>'/review/standby', 'permit'=>array('editor', 'reporter')),
									array('code' => '0403', 'title'=>'발행된 리뷰', 'url'=>'/review/list', 'permit'=>array('editor', 'reporter'))
							   )
					),

				array(
					'code' => '05',
					'title' => '화면 관리',
					'url' => '#',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '0501', 'title'=>'Top 기사 관리', 'url'=>'/news/top', 'permit'=>array('editor')),
									array('code' => '0502', 'title'=>'메인 섹션 관리', 'url'=>'/news/isan', 'permit'=>array('editor')),
									array('code' => '0503', 'title'=>'메인 미리보기', 'url'=>"javascript:openPop('prieveiwMain', '/preview/main')", 'permit'=>array('editor')),
									array('code' => '0504', 'title'=>'오피니언 미리보기', 'url'=>"javascript:openPop('prieveiwMain', '/preview/opinion')", 'permit'=>array('editor')),
									array('code' => '0505', 'title'=>'기사/오피니언 엎기', 'url'=>'javascript:;js_published_all()', 'permit'=>array('editor'))
								)
					),

				array(
					'code' => '06',
					'title' => '소식 관리',
					'url' => '#',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '0601', 'title'=>'알림 관리', 'url'=>'/alim/list', 'permit'=>array('editor'))
									//array('code' => '0601', 'title'=>'뉴스레터 관리', 'url'=>'#', 'permit'=>array('editor')),									
								)
					),

				array(
					'code' => '07',
					'title' => '편집/발행 관리',
					'url' => '#',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '0701', 'title'=>'편집 대기', 'url'=>'/publish/standby', 'permit'=>array('editor')),
									array('code' => '0702', 'title'=>'발행된 기사', 'url'=>'/publish/published', 'permit'=>array('editor')),
									array('code' => '0703', 'title'=>'작성 중 기사', 'url'=>'/publish/tempstored', 'permit'=>array('editor')),
									array('code' => '0704', 'title'=>'민소픽 관리', 'url'=>'/publish/minsopick', 'permit'=>array('editor')),
									array('code' => '0705', 'title'=>'칼럼 관리', 'url'=>'/publish/column', 'permit'=>array('editor')),
									array('code' => '0706', 'title'=>'네이버/다음 전송', 'url'=>'/publish/portal', 'permit'=>array('editor'))
								)
					),

				array(
					'code' => '08',
					'title' => '계정관리',
					'url' => '/member/list',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '0801', 'title'=>'계정관리', 'url'=>'/member/list', 'permit'=>array('editor')),
									array('code' => '0802', 'title'=>'계정등록', 'url'=>'/member/write', 'permit'=>array('editor'))
								)
					),

				array(
					'code' => '09',
					'title' => '카테고리관리',
					'url' => '/category/list_news_kind',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '0901', 'title'=>'기사종류 관리', 'url'=>'/category/list_news_kind', 'permit'=>array('editor')),
									array('code' => '0902', 'title'=>'기사분류 관리', 'url'=>'/category/list_news_category', 'permit'=>array('editor'))
								)
					),

				array(
					'code' => '10',
					'title' => '관리자관리(내부IP에서만 보임)',
					'url' => '/admin/list_admin_group',
					'permit' => array('editor'),
					'depth2' => array(
									array('code' => '1001', 'title'=>'관리자그룹관리', 'url'=>'/admin/list_admin_group', 'permit'=>array('editor'))
								)
					)
			);
?>
