<?php

include "../includes/header.php"; 

?>

<div class="container mt-5">
    <h2 class="text-center">Sales Report</h2>
    <form method="POST" action="" class="mb-4">
        <div class="mb-3">
            <label for="selected_date" class="form-label">Select Date</label>
            <input type="date" name="selected_date" class="form-control" value="<?php echo htmlspecialchars($selected_date); ?>" required onchange="this.form.submit();">
        </div>
    </form>

    <div class="border p-3 mb-4">
        <h3>Today's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display today's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display today's net revenue --></strong></p>
        </div>
    </div>

    <div class="border p-3 mb-4">
        <h3>Yesterday's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display yesterday's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display yesterday's net revenue --></strong></p>
        </div>
    </div>

    <div class="border p-3 mb-4">
        <h3>This Week's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display this week's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display this week's net revenue --></strong></p>
        </div>
    </div>

    <div class="border p-3 mb-4">
        <h3>Last Week's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display last week's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display last week's net revenue --></strong></p>
        </div>
    </div>

    <div class="border p-3 mb-4">
        <h3>This Month's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display this month's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display this month's net revenue --></strong></p>
        </div>
    </div>

    <div class="border p-3 mb-4">
        <h3>Last Month's Sales</h3>
        <div class="mb-2">
            <p>Number of Sales: <strong><!-- PHP code to display last month's sales number --></strong></p>
        </div>
        <div class="mb-2">
            <p>Net Revenue: <strong><!-- PHP code to display last month's net revenue --></strong></p>
        </div>
    </div>
</div>