<div class="col-2">
    <nav class="nav" id="column-left">
        <div id="navigation">
            NAVIGATION
        </div>
        <ul id="menu">
        	<li class="active"><a href="#">Items Area</a></li>
                <ul>
                    <li><a href="{{ route('items.index') }}">All Items</a></li>
                    @if(Auth::user()->type === 'admin')
                        <li><a href="{{ route('items.create') }}">Add Items</a></li>
                        <li><a href="{{ route('items.downloadItemsCSV') }}">Download Items CSV</a></li>
                     @endif
                    @if(Auth::user()->type === 'vendor')
                        <li><a href="{{ route('items.addItemToMenu') }}">Add Items in Menu</a></li>
                    @endif
                    <!-- <li><a href="{{ route('getAddToCart') }}">Add To Cart</a></li> -->
                    <!-- <li><a href="{{ url('/uploadCsv') }}">Upload CSV</a></li> -->
                </ul>
            <li><a href="#">Orders Area</a></li>
                <ul>
                    <li><a href="{{ route('orders.index') }}">All Orders</a></li>
                    <li><a href="{{ route('orders.searchOrders','completed') }}">Completed Orders</a></li>
                    <li><a href="{{ route('orders.searchOrders','processed') }}">Processed Orders</a></li>
                    @if(Auth::user()->type === 'vendor')
                        <li><a href="{{ route('orders.create') }}">Add Orders</a></li>
                    @endif
                </ul>
            @if(Auth::user()->type === 'vendor')
            <li><a href="#">Inventry Area</a></li>
                <ul>
                    <li><a href="{{ route('items.index') }}">Update Inventry Through CSV</a></li>
                    <li><a href="{{ route('items.downloadCurrentInventry') }}">Download Current Inventry</a></li>
                    <li><a href="{{ route('items.getClosingStock') }}">CLosing Stock</a></li>
                    <li><a href="{{ route('items.exportClosingStockCSV') }}">Export CLosing Stock</a></li>
                    <li><a href="{{ route('items.getPurchaseReport') }}">Perchase Report</a></li>
                    <li><a href="{{ route('items.exportPurchaseReportCSV') }}">Export Perchase Report</a></li>
                    <li><a href="{{ route('items.getConsumptionReport') }}">Consuption Report</a></li>
                    <li><a href="{{ route('items.exportConsumptionReportCSV') }}">Export Consuption Report</a></li>
                </ul>
            @endif
            @if(Auth::user()->type === 'admin')
            <li><a href="#">User Area</a></li>
                <ul>
                    <li><a href="{{ route('users.index') }}">All users</a></li>
                    <li><a href="{{ route('users.getUsersByType','vendor') }}">All Vendors</a></li>
                    <li><a href="{{ route('users.getUsersByType','employee') }}">All Emloyees</a></li>
                    <li><a href="{{ route('users.getUsersByType','client') }}">All Clients</a></li>
                    <li><a href="{{ route('users.create') }}">Add user</a></li>
                    <!-- <li><a href="{{ route('roles.index') }}">All roles</a></li> -->
                </ul>
            <li><a href="#">Manage Feedbacks</a></li>
                <ul>
                    <li><a href="{{ route('feedbacks.getFeedbacks') }}">All feedbacks</a></li>
                </ul> 
            <!-- <li><a href="#">Manage Roles</a></li>
                <ul>
                    <li><a href="{{ route('roles.index') }}">All roles</a></li>
                </ul> -->
            @endif
        </ul>
    </nav>
</div>
