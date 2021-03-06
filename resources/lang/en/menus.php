<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

	'menu' =>'Menu',
	'managetitle'=>'Management',
	'element'=>'Element',
	'order'=>'Order',
	'site_manage'=>['shop'=>'Shop',
			'email'=>'Email'
	],
	'manage'=>['shop'=>'Shop',
			'coupon'=>'Coupon',
			'printer'=>'Printer',
			'email'=>'Email',
			'notice'=>'Notification',
			'blacklist'=>'Blacklist'
	],
	'menu_manage'=>['type'=>'Type',
			'catalogue'=>'Catalogue',
			'dish'=>'Dish',
			'material'=>'Material',
			'tag'=>'Tag'
	],
	'element_manage'=>['material_type'=>'Type','material'=>'Material','group'=>'Group'],
		
	'order_manage'=>['order_list'=>'Order List','order_data'=>'Order Data'],
		
	'action'=>'Action',
		
	'session'=>['expire'=>'Your session has expired. Please re-start your order.'],
	'empty_order'=>'There are no products in your order. Please update your order before continuing to payment.',
	'invalidip'=>'For some reasons, your ip address is added to the blacklist. If you want to make an order, please contact with the shop staff.',
		
    'active_users' => 'Active Users',
    'banned_users' => 'Banned Users',
    'create_permission' => 'Create Permission',
    'create_permission_group' => 'Create Group',
    'create_role' => 'Create Role',
    'create_user' => 'Create User',
    'dashboard' => 'Dashboard',
	
    'deactivated_users' => 'Deactivated Users',
    'deleted_users' => 'Deleted Users',
    'edit_permission' => 'Edit Permission',
    'edit_permission_group' => 'Edit Group',
    'edit_role' => 'Edit Role',
    'edit_user' => 'Edit User',
    'general' => 'General',
    'header_buttons' => [
        'permissions' => [
            'all' => 'All Permissions',
            'button' => 'Permissions',

            'groups' => [
                'all' => 'All Groups',
                'button' => 'Groups',
            ],
        ],
        'roles' => [
            'all' => 'All Roles',
            'button' => 'Roles',
        ],
        'users' => [
            'all' => 'All Users',
            'button' => 'Users',
        ],
    ],
    'log-viewer' => [
        'main' => 'Log Viewer',
        'dashboard' => 'Dashboard',
        'logs' => 'Logs',
    ],
    'permission_management' => 'Permission Management',
    'role_management' => 'Role Management',
    'user_management' => 'User Management',
    'access_management' => 'Access Management',
    'language-picker' => [
        'language' => 'Language',
        'langs' => [
            'en' => 'English',
            'cn' => '中文',
        ],
    ],
];
