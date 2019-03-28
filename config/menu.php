<?php

return [

	"index"=>[
		'name'=>"首页",
		'urls'=>'/admin'
	],

	'user'=>[
		'name'=>'用户管理',
		'subMenu'=>[
			'add'=>[
				'name'=>'用户新增',
				'urls'=>'/admin/user/add'
			],
			'del'=>[
				'name'=>'用户删除',
				'urls'=> '/admin/user/del'
			],


		]
	],

//角色管理
	'role'=>[
		'name'=>'角色管理',

		'subMenu'=>[
			[
				'name'=>'角色新增',
				'urls'=> '/admin/role/create',
			],
			[
				'name'=>'角色删除',
				'urls'=> '/admin/role/del',

			],

		]
	],


//角色管理
	'access'=>[
		'name'=>'权限管理',
		'urls'=> '/admin/role',

	],


];