<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Rest Service</title>
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <link href="template/css/style.css" rel="stylesheet">
    <style>
        .user-form{
            float: right;
        }
        .registration{
            display: none;
        }
        .user-info{
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Car Service<small> (REST)</small></h1>

        <div class="user-form">

            <div class="user-info" id='user-info'>
                Hello, <span name="infoUsername">user</span>
                <br>
                <button type="submit" class="btn btn-defalut" onclick="logout()">Logout</button>
            </div>

            <div class="login" id="login">
                <h4>Login</h4>
                <!--div>
                    <label for="login-username">Username</label>
                    <input type="text" name="login-username" id="login-username" placeholder="Enter username">
                </div>
                <div>
                    <label for="login-password">Password</label>
                    <input type="password" name="login-password" id="login-password">
                </div-->
                <div>
                    <button type="submit" class="btn btn-defalut" onclick="login()">Login</button>
                    <button type="submit" class="btn btn-defalut" onclick="getRegisterForm()">Register</button>
                </div>


            </div>
        </div>
        <div class="registration row" id="registration">
            <h4>Registration</h4>
            <form id="registrationForm" role="form" class="col-lg-4" action="javascript:void(0);">
                <div>
                    <label for="register-email">Email</label>
                    <input type="email" class="form-control" name="register-email" id="register-email" placeholder="example@mailserver.com">
                </div>
                <div>
                    <label for="register-username">Username</label>
                    <input type="text" class="form-control" name="register-username" id="register-username" placeholder="Enter your name">
                </div>
                <div>
                    <label for="register-password">Password</label>
                    <input type="register-password" class="form-control" name="register-password" id="register-password">
                </div>
                <button type="submit" class="btn btn-defalut" onclick="register()">Register</button>
            </form>
        </div>


        <div class="form-group ">
            <button type="submit" class="btn btn-success" onclick="getCarList()">Get all cars list</button>
        </div>



        <div class="form-group row">
            <div class="col-lg-4">
                <h3>Filter options</h3>
                <button type="submit" class="btn btn-success" onclick="searchCars()">Search</button>
                <div class="input-group">
                    <span class="input-group-addon">
                        Mark
                    </span>
                    <select class="form-control" name="mark" id="mark">
                        <option value="">-----Select mark</option>
                        <option>Audi</option>
                        <option>BMW</option>
                        <option>Chevrolet</option>
                        <option>Toyota</option>
                        <option>Mercedes</option>
                        <option>Nissan</option>
                        <option>Peugeot</option>
                        <option>Renault</option>

                    </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Model
                    </span>
                    <input type="text" class="form-control" name="model" id="model" value="" />
                </div>
                <div class="input-group">
                    <span class="input-group-addon col">
                        <b>Year *</b>
                    </span>
                    <input type="number" class="form-control" name="year" min="0" id="year" value="" />
                    <span class="input-group-addon">year</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Engine
                    </span>
                    <input type="number" step="0.1" min="0" class="form-control" name="engine" id="engine" value="" />
                    <span class="input-group-addon">L</span>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Color
                    </span>
                    <select class="form-control" name="color" id="color">
                        <option value="">-----Select color</option>
                        <option>black</option>
                        <option>white</option>
                        <option>metallic</option>
                        <option>red</option>
                        <option>blue</option>
                        <option>green</option>
                        <option>orange</option>
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-addon">
                        Max speed
                    </span>
                    <input type="number" min="0" class="form-control col-lg-3" name="maxspeed" id="maxspeed" value="" />
                    <span class="input-group-addon">km/h</span>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        Price
                    </span>
                    <input type="number" min="0" class="form-control col-lg-3" name="price" id="price" value="" />
                    <span class="input-group-addon">$</span>
                </div>
                <span class="help-block">* Year field is required</span>
            </div>

            <div class="col-lg-7 detail" id="detail">
                <table class="table" id="details">
                </table>
            </div>

        </div>


        <div class="results" id="results">
            <table class="table" id="table">

            </table>
        </div>


        <div class="order-form" id="order-form" style="display: none;">

            <h2>Pre order car</h2>

            <div class="row">
                <div name="carorder" class="col-lg-5" id="carorder">
                    <input type="hidden" name="order-car-id" id="order-car-id" value="" />

                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="" placeholder="Enter your Name">

                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" name="surname" id="surname" value="" placeholder="Enter your Surname">

                    <label for="paytype">Select type pay</label>
                    <select class="form-control" name="paytype" id="paytype">
                        <option value="credit card">Credit card</option>
                        <option value="cash">Cash</option>
                    </select>
                    <button type="submit" class="btn btn-warning" onclick="order()">Order</button>

                    <div class="text-danger" id="errorsOrderForm"></div>
                </div>
            </div>

        </div>


    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>

    <script src="template/js/main.js"></script>
</body>
</html>