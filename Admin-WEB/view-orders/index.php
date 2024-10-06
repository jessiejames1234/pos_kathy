 <?php
 include '../includes/header.php';
 ?> 

            <div class="table-container container mt-4">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer Name</th>
                            <th>Items Ordered</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Customer 1</td>
                            <td>Item 1, Item 2</td>
                            <td>$100</td>
                            <td>2024-09-23</td>
                            <td>Unpaid</td>
                            <td>Pending</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Customer 2</td>
                            <td>Item 3</td>
                            <td>$50</td>
                            <td>2024-09-23</td>
                            <td>Unpaid</td>
                            <td>Pending</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Customer 3</td>
                            <td>Item 4, Item 5</td>
                            <td>$150</td>
                            <td>2024-09-23</td>
                            <td>Unpaid</td>
                            <td>Pending</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>