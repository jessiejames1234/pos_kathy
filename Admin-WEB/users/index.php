    <?php 
        include "../includes/header.php";
        include "../../Classes/User.php"; 
        $user = new User;

        $user_list = $user->displayUsers(); // Fetch user data
    ?> 
            <div class="table-container container">
                <div class="col text-end mb-3">
                    <a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fa-regular fa-square-plus fa-flip-vertical fa-1x"></i> Add New User
                    </a>
                </div>
                <?php if(empty($user_list)): ?>
                    <div class="container-fluid bg-dark p-5 text-danger text-center">
                        <h1 class="display-6 fw-bold pt-5 pb-3">No Users Found</h1>
                        <i class="fa-regular fa-circle-xmark fa-8x pb-5"></i>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user_list as $user): ?>
                            <tr>
                                <td class="text-center" valign="middle"><?= $user['id'] ?></td>
                                <td class="text-center" valign="middle"><?= $user['first_name'] ?> <?= $user['last_name'] ?></td> 
                                <td class="text-center" valign="middle"><?= $user['username'] ?></td>
                                <td class="text-center" valign="middle"><?= $user['role'] ?></td>
                                <td class="text-center" valign="middle">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                    onclick="populateEditModal(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['first_name']); ?>', '<?php echo htmlspecialchars($user['last_name']); ?>', '<?php echo htmlspecialchars($user['username']); ?>', '<?php echo htmlspecialchars($user['role']); ?>');" 
                                    style="text-decoration: none;">
                                        <i class="fa-solid fa-pen-to-square fa-2x" style="color: #63E6BE;"></i>
                                </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

    <?php include "../modals/edit_user.php"; ?>
    <?php include "../modals/add-user.php"; ?>
<script>
function populateEditModal(id, firstName, lastName, username, role) {
    document.getElementById('user_id').value = id;
    document.getElementById('first_name').value = firstName;
    document.getElementById('last_name').value = lastName;
    document.getElementById('username').value = username;
    document.getElementById('role').value = role;
}
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>