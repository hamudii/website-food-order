<?php include('partials/header.php'); ?>
        <!-- main START -->
        <section class="admin manage-admin">
            <div class="container">
                <div class="row mb-1">
                    <div class="col mt-5">
                          <h3 class="text-dark">Manage Admin</h3>
                    </div>
                </div>
                <?php
                    if(isset($_SESSION['add'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>'.$_SESSION['add'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['add']);
                    } else if(isset($_SESSION['delete'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-danger fs-5"><em>'.$_SESSION['delete'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['delete']);
                    } else if(isset($_SESSION['edit'])){
                        echo '
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h4 class="text-success fs-5"><em>'.$_SESSION['edit'].'</em></h4>
                                </div>
                            </div>
                            ';
                        unset($_SESSION['edit']);
                    }
                ?>
                <div class="addAdmin">
                    <a href="add-admin.php" class="btn btn-primary mb-2">Add Admin</a>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //Select data admin dari database
                            $sql = "SELECT * FROM admin";
                            //Eksekusi Query
                            $result = mysqli_query($conn, $sql) or die("Query gagal dijalankan: " . mysqli_errno($conn));
                            //Cek query
                            if($result){
                                //hitung banyak baris
                                $row = mysqli_num_rows($result);

                                //Jika ada data
                                if($row > 0){
                                    $number = 1;
                                    //Looping data
                                    while($data = mysqli_fetch_assoc($result)){
                                        echo '
                                            <tr>
                                                <th scope="row">'.$number++.'</th>
                                                <td>'.$data['username'].'</td>
                                                <td>'.$data['password'].'</td>
                                                <td>
                                                    <a href="edit-admin.php?id='.$data['id_admin'].'" class="btn btn-primary btn-sm btn-success">Edit Admin</a>
                                                    <a href="delete-admin.php?id='.$data['id_admin'].'" class="btn btn-primary btn-sm btn-danger">Delete Admin</a>
                                                </td>
                                            </tr>';}
                                }else{
                                    echo '<tr>';
                                    echo '<td colspan="4" class="table-danger">Data tidak ditemukan!</td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- main END -->
<?php include('partials/footer.php'); ?>
