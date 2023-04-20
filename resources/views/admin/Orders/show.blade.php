// extend the layout from the admin layout file
    @extends ( 'admin.layouts.app' )

    // set the page title
    @section ( 'title' ,   'Order Details' )

    // set the active sidebar element
    @section ( 'active' ,   'orders' )

    // set the page content
    @section ( 'content' )
            <h1>Order Details</h1>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h3>Order Information</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Order ID</th>
                            <td>123</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>any</td>
                        </tr>
                        <tr>
                            <th>Order Status</th>
                            <td>active</td>
                        </tr>
                        <tr>
                            <th>Order Total</th>
                            <td>5000</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Customer Information</h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Customer Name</th>
                            <td>Hassan</td>
                        </tr>
                        <tr>
                            <th>Customer Email</th>
                            <td>hassan@gmail.com</td>
                        </tr>
                        <tr>
                            <th>Customer Phone</th>
                            <td>1541421911</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>

    @endsection

