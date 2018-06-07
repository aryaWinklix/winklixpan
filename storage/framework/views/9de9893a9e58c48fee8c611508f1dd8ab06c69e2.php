<div class="col-2">
    <nav class="nav" id="column-left">
        <div id="navigation">
            NAVIGATION
        </div>
        <ul id="menu">
        	<li class="active"><a href="#">Items Area</a></li>
                <ul>
                    <?php if(Auth::user()->type === 'admin'): ?>
                        <li><a href="<?php echo e(route('items.create')); ?>">Add Items</a></li>
                     <?php endif; ?>
                    <li><a href="<?php echo e(route('items.index')); ?>">All Items</a></li>
                    <?php if(Auth::user()->type === 'vendor'): ?>
                        <li><a href="<?php echo e(route('items.addItemToMenu')); ?>">Add Items in Menu</a></li>
                    <?php endif; ?>
                    <!-- <li><a href="<?php echo e(route('getAddToCart')); ?>">Add To Cart</a></li> -->
                    <!-- <li><a href="<?php echo e(url('/uploadCsv')); ?>">Upload CSV</a></li> -->
                </ul>
            <li><a href="#">Orders Area</a></li>
                <ul>
                    <li><a href="<?php echo e(route('orders.index')); ?>">All Orders</a></li>
                    <?php if(Auth::user()->type === 'vendor'): ?>
                        <li><a href="<?php echo e(route('orders.create')); ?>">Add Orders</a></li>
                    <?php endif; ?>
                </ul>
            <?php if(Auth::user()->type === 'admin'): ?>
            <li><a href="#">User Area</a></li>
                <ul>
                    <li><a href="<?php echo e(route('users.index')); ?>">All users</a></li>
                    <li><a href="<?php echo e(route('users.getUsersByType','vendor')); ?>">All Vendors</a></li>
                    <li><a href="<?php echo e(route('users.getUsersByType','employee')); ?>">All Emloyees</a></li>
                    <li><a href="<?php echo e(route('users.getUsersByType','client')); ?>">All Clients</a></li>
                    <li><a href="<?php echo e(route('users.create')); ?>">Add user</a></li>
                    <!-- <li><a href="<?php echo e(route('roles.index')); ?>">All roles</a></li> -->
                </ul>
            <li><a href="#">Manage Roles</a></li>
                <ul>
                    <li><a href="<?php echo e(route('roles.index')); ?>">All roles</a></li>
                </ul>
            <?php endif; ?>
        </ul>
    </nav>
</div>