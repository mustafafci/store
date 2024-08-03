<div class="row mb-3">
    <div class="col-md-6 ">
        <x-form.label for="first_name" label="First Name" />
        <x-form.input name="first_name" :value="$user->first_name" />
    </div>
    <div class="col-md-6 ">
        <x-form.label for="last_name" label="Last Name" />
        <x-form.input name="last_name" :value="$user->last_name" />
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-6 ">
        <x-form.label for="phone" label="Phone" />
        <x-form.input name="phone" :value="$user->phone" />
    </div>
    <div class="col-md-6 ">
        <x-form.label for="birthday" label="birthday" />
        <x-form.input type="date" name="birthday" :value="$user->birthday" />
    </div>
</div>


<div class="row mb-3">
    <div class="col-md-6 ">
        <x-form.label for="gender" label="Gender" />
        <x-form.select name="gender" :options="['' => 'Select Gender', 'male' => 'Male', 'female' => 'Female']" :selected="$user->gender" />
    </div>
    <div class="col-md-6 ">
        <x-form.label for="street_address" label="street_address" />
        <x-form.input name="street_address" :value="$user->street_address" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-4">
        <x-form.label for="country" label="country" />
        <x-form.input name="country" :value="$user->country" />
    </div>
    <div class="col-md-4">
        <x-form.label for="city" label="city" />
        <x-form.input name="city" :value="$user->city" />
    </div>
    <div class="col-md-4">
        <x-form.label for="postal_code" label="postal_code" />
        <x-form.input name="postal_code" :value="$user->postal_code" />
    </div>
</div>
<div class="div">
    <button class="btn btn-primary">Save</button>
</div>
