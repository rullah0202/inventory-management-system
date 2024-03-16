<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""><i class="fal fa-inventory"></i> Inventory</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href=""></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('/') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_home') }}"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li class="{{ Request::is('supplier/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('supplier_show') }}"><i class="fas fa-hand-point-right"></i><span>Manage Suppliers</span></a></li>

            
            <li class="{{ Request::is('unit/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('unit_show') }}"><i class="fas fa-weight"></i><span>Manage Units</span></a></li>
            
            <li class="{{ Request::is('category/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('category_show') }}"><i class="fas fa-hand-point-right"></i><span>Manage Categories</span></a></li>
            
            <li class="nav-item dropdown {{ Request::is('customer/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Manage Customers</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('customer/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('customer_show') }}"><i class="fas fa-angle-right"></i><span>All Customers</span></a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('customer/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('credit.customer') }}"><i class="fas fa-angle-right"></i><span>Credits Customers</span></a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('customer/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('paid.customer') }}"><i class="fas fa-angle-right"></i><span>Paid Customers</span></a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('customer/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('customer.wise.report') }}"><i class="fas fa-angle-right"></i><span>Customer Wise Report</span></a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('product/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-product-hunt"></i><span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('product/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('product_show') }}"><i class="fas fa-angle-right"></i><span>All Products</span></a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('purchase/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cash-register"></i><span>Manage Purchases</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('purchase/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('purchase_show') }}"><i class="fas fa-angle-right"></i><span>All Purchases</span></a></li>
                    <li class="{{ Request::is('purchase/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('daily.purchase.report') }}"><i class="fas fa-angle-right"></i><span>Date Wise Purchases</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('invoice/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice"></i><span>Manage Invoices</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('invoice/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('invoice_show') }}"><i class="fas fa-angle-right"></i><span>All invoices</span></a></li>
                    <li class="{{ Request::is('invoice/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('daily.invoice.report') }}"><i class="fas fa-angle-right"></i><span>Date Wise Invoices</span></a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('stock/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-invoice"></i><span>Manage Stock</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('stock/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('stock.report.pdf') }}"><i class="fas fa-angle-right"></i><span>Stock Report</span></a></li>
                    <li class="{{ Request::is('stock/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('stock_supplier_category_wise') }}"><i class="fas fa-angle-right"></i><span>Supplier / Category Wise </span></a></li>
                </ul>
            </li>
            
            {{-- <li class="{{ Request::is('admin/setting')||Request::is('admin/setting/*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_setting') }}"><i class="fas fa-cog"></i> <span>Setting</span></a></li> --}}


            {{-- <li class="{{ Request::is('admin/author/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_author_show') }}"><i class="fas fa-user-edit"></i> <span>Author List</span></a></li> --}}
            
            {{-- <li class="nav-item dropdown {{ Request::is('admin/top-advertisement')||Request::is('admin/home-advertisement')||Request::is('admin/sidebar-advertisement-*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ad"></i><span>Advertisements</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/top-advertisement') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_top_advertisement') }}"><i class="fas fa-angle-right"></i> Top Advertisement</a></li>
                    <li class="{{ Request::is('admin/home-advertisement') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_home_advertisement') }}"><i class="fas fa-angle-right"></i> Home Advertisement</a></li>
                    <li class="{{ Request::is('admin/sidebar-advertisement') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_sidebar_ad_show') }}"><i class="fas fa-angle-right"></i> Sidebar  Advertisement</a></li>

                </ul>
            </li>

            <li class="nav-item dropdown  {{ Request::is('admin/category-*')||Request::is('admin/sub-category-*')||Request::is('admin/post-*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-newspaper"></i><span>News</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/category-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_category_show') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/sub-category-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_sub_category_show') }}"><i class="fas fa-angle-right"></i> SubCategories</a></li>
                    <li class="{{ Request::is('admin/post-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_post_show') }}"><i class="fas fa-angle-right"></i> Posts</a></li>

                </ul>
            </li>
            <li class="nav-item dropdown  {{ Request::is('admin/about')||Request::is('admin/faq')||Request::is('admin/contact')||Request::is('admin/disclaimer')||Request::is('admin/login_author')||Request::is('admin/terms')||Request::is('admin/privacy') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-copy"></i><span>Pages</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/about') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_about') }}"><i class="fas fa-angle-right"></i> About</a></li>
                    <li class="{{ Request::is('admin/faq') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_faq') }}"><i class="fas fa-angle-right"></i> FAQ</a></li>
                    <li class="{{ Request::is('admin/disclaimer') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_disclaimer') }}"><i class="fas fa-angle-right"></i> Disclaimer</a></li>
                    <li class="{{ Request::is('admin/contact') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_contact') }}"><i class="fas fa-angle-right"></i> Contact</a></li>
                    <li class="{{ Request::is('admin/terms') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_terms') }}"><i class="fas fa-angle-right"></i> Terms & Conditions</a></li>
                    <li class="{{ Request::is('admin/privacy') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_privacy') }}"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>
                    <li class="{{ Request::is('admin/login_author') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_login_author') }}"><i class="fas fa-angle-right"></i> Login Author</a></li>

                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('admin/subscriber/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Subscribers</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/subscriber/all') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscribers') }}"><i class="fas fa-angle-right"></i> All Subscribers</a></li>
                    <li class="{{ Request::is('admin/subscriber/send-email') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_send_email') }}"><i class="fas fa-angle-right"></i> Send Email to All</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('/admin/photo-gallery-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_photo_gallery_show') }}"><i class="fas fa-camera"></i><span>Photo Gallery</span></a></li>
            <li class="{{ Request::is('/admin/video-gallery-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_video_gallery_show') }}"><i class="fas fa-video"></i> <span>Video Gallery</span></a></li>
            <li class="{{ Request::is('/admin/live-channel-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_live_channel_show') }}"><i class="fab fa-google-drive"></i> <span>Live channel</span></a></li>
            <li class="{{ Request::is('/admin/online-poll-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_online_poll_show') }}"><i class="fas fa-vote-yea"></i><span>Online Poll</span></a></li>


            <li class="{{ Request::is('admin/faq-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_faq_show') }}"><i class="fas fa-question-circle"></i><span>FAQ</span></a></li>
            <li class="{{ Request::is('admin/socialitem-*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('admin_socialitem_show') }}"><i class="fas fa-share-alt"></i> <span>Social Item</span></a></li> --}}


            {{-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Dropdown Items</span></a>
                <ul class="dropdown-menu">
                    <li class="active"><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 1</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 2</a></li>
                </ul>
            </li> --}}

            {{-- <li class=""><a class="nav-link" href="setting.html"><i class="fas fa-hand-point-right"></i> <span>Setting</span></a></li>

            <li class=""><a class="nav-link" href="form.html"><i class="fas fa-hand-point-right"></i> <span>Form</span></a></li>

            <li class=""><a class="nav-link" href="table.html"><i class="fas fa-hand-point-right"></i> <span>Table</span></a></li>

            <li class=""><a class="nav-link" href="invoice.html"><i class="fas fa-hand-point-right"></i> <span>Invoice</span></a></li> --}}

        </ul>
    </aside>
</div>