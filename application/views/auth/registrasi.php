<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <img src="../assets/img/logo.png" alt="Logo" width="100px" style="margin-bottom: 20px;">
                            <h1 class="h4 text-gray-900 mb-4">BAPENDIK - SIGN UP</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registrasi'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Full Name" value="<?= set_value('nama'); ?>">
                                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nip" name="nip" placeholder="NIP" value="<?= set_value('nip'); ?>">
                                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="pass1" name="pass1" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="pass2" name="pass2" placeholder="Repeat Password">
                                </div>
                                <?= form_error('pass1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                REGISTER
                            </button>
                            <button type="button" class="btn btn-secondary btn-user btn-block" id="resetButton">
                                RESET
                            </button>
                        </form>
                        <hr>
                        <div class="btn btn-light btn-user btn-block">
                            <a href="<?= base_url('bapendik') ?>"><i class="fas da-plus"></i>BACK</a>
                        </div>
                        <!-- <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('nama').value = '';
            document.getElementById('email').value = '';
            document.getElementById('nip').value = '';
            document.getElementById('pass1').value = '';
            document.getElementById('pass2').value = '';
        });
    });
</script>