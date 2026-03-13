<form class="user" data-username="<?= $username; ?>">
    <div class="form-group mb-2">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" id="firstname" name="firstname">
    </div>
    <div class="form-group mb-2">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" id="lastname" name="lastname">
    </div>

     <div class="form-group mb-2">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>

     <div class="form-group mb-2">
        <label for="mobile" class="form-label">Mobile</label>
        <input type="text" class="form-control" id="mobile" name="mobile">
    </div>

     <div class="form-group mb-2">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>

     <div class="form-group mb-2">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>

    <div class="form-group mb-2">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select">
        </select>
    </div>
  <div class="form-group mb-2">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" id="gender" class="form-select">
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
    </div>

    <div class="d-flex justify-content-end align-items-center">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>