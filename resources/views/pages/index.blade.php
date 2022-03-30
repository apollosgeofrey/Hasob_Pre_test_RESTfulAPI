<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
</head>
<body>
    <div class="card-header text-center jumbotron alert alert-success"><h3>HASOB Pre-Assessment Test API Dashboard</h3></div>
    <div class="container">
        <blockquote class="row justify-content-center">
            <h3> Pre-Assessment Test </h3> <br><br>

        
        <h4>1.1 CRUD API Documentation to POST/create/register as a new user and obtain TOKEN</h4>

            EndpointURL --: http://localhost:8000/api/users/register<br><br>

        Fields content which includes the following listed below are to be POSTed to the Endpoint URL.<br>
            string('firstName')         Required;<br>
            string('middleName')        Optional;<br>
            string('lastName')          Required;<br>
            string('email')             Required;<br>
            string('phoneNumber')       Required;<br>
            string('pictureURL')        Optional;<br>
            string('password')          Required;<br><br>

        Possible Errors are returned if encountered<br><br>

        Clients must to accept JSON data at their header configuration<br><br><br>



        <h4>1.2 CRUD API Documentation to POST/login/signin as an existing user and obtain TOKEN</h4>

            EndpointURL --: http://localhost:8000/api/users/login<br><br>

            Fields content which includes the following listed below are to be POSTed to the Endpoint URL.<br>
            string('email')             Required;<br>
            string('password')          Required;<br><br>

        Possible Errors are returned if encountered<br><br>

        Clients must to accept JSON data at their header configuration<br><br><br>

<h3><font color="red"><i><center>NOTE: the above routes (login & register) can be assessed without the TOKEN, all routes below requires the TOKEN field for authentication.</center></i></font></h3>    
        
        <h4>1.3 CRUD API Documentation to GET/retrieve authenticated registered user</h4>

            EndpointURL --: http://localhost:8000/api/users/user<br><br>
            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>

            string('token')             Required;<br><br>
        
            Possible Errors are returned if encountered <br><br>

            Clients must to accept JSON data at their header configuration<br><br><br>



        <h4>1.4 CRUD API Documentation to GET/logout/singout a loggedin user</h4>

           EndpointURL --: http://localhost:8000/api/users/logout<br><br>
            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>

            string('token')             Required;<br><br>
        
            Possible Errors are returned if encountered <br><br>

            Clients must to accept JSON data at their header configuration<br><br><br>



        <h4>1.5 CRUD API Documentation to GET/retrieve all resgistered users</h4>

           EndpointURL --: http://localhost:8000/api/users/allusers<br><br>
            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>

            string('token')             Required;<br><br>
        
            Possible Errors are returned if encountered <br><br>

            Clients must to accept JSON data at their header configuration<br><br><br>



        <h4>1.6 CRUD API Documentation to GET/retrieve unique resgistered user by Email Address</h4>

            EndpointURL --: http://localhost:8000/api/users/uniqueuser/{proivde_users_email}<br><br>

            Example --: http://localhost:8000/api/users/uniqueuser/apollosgeofrey@gmail.com<br><br>
    
            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>

            string('token')             Required;<br><br>
        
            Possible Errors are returned if encountered <br><br>

            Clients must to accept JSON data at their header configuration<br><br><br>


        <h4>1.7 CRUD API Documentation to PUT/update registered and active user records excluding email</h4>

            EndpointURL --: http://localhost:8000/api/users/updateuser<br><br>
    
            Fields content which includes the following listed below are to be passed with the PUT method to the Endpoint URL.<br>

            string('token')             Required;<br><br>

            {Fields -> value} contents are to be PUT to the Endpoint URL.<br><br>

            Only selected fields to be updated can be PUT to request payload.<br><br><br>


        <h4>1.8 CRUD API Documentation to DELETE/delete registered user records</h4>

            EndpointURL --: http://localhost:8000/api/users/removeuser<br><br>
    
            Fields content which includes the following listed below are to be passed with the DELETE  method to the Endpoint URL.<br>

            string('token')             Required;<br><br>

            Records of specified email at associated to the passed token will be deleted immediately.<br><br><br>




        <h4> 2.1 CRUD API Documentation to GET/retrieve all assets in the server </h4>

            EndpointURL --: http://localhost:8000/api/assets/allassets<br><br>

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 2.2 CRUD API Documentation to GET/retrieve unique assets by assets_serial Number only </h4>

            EndpointURL --: http://localhost:8000/api/assets/uniqueasset/{asset_serialNumber} <br><br>

                Example --: http://localhost:8000/api/assets/uniqueasset/Hk99ijh9JI9yhuU99u78Y<br><br>

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 2.3 CRUD API Documentation to POST/create/register a new Asset </h4>

            EndpointURL --: http://localhost:8000/api/assets/newasset<br><br>

                Fields content which includes the following listed below are to be POSTed to the Endpoint URL.
                    <br> string('type')                          Required;
                    <br> string('serialNumber')                  Required;
                    <br> string('description')                   Required;
                    <br> string('fixed_movable')                 Optional;
                    <br> string('picturePath')                   Optional;
                    <br> string('purchaseDate')                  Optional;
                    <br> string('startUseDate')                  Optional;
                    <br> string('purchasePrice')                 Required;
                    <br> string('warrantyExpiryDate')            Optional;
                    <br> string('degradationInYears')            Optional;
                    <br> string('currentValueInNaira')           Optional;
                    <br> string('location')                      Optional;
                    <br> string('token')                         Required;

                <br><br>Possible Errors are returned if encountered

                Requesting clients must accept JSON data at their header configuration<br><br><br>


        <h4> 2.4 CRUD API Documentation to PUT/update a registered Asset records excluding serialNumber </h4>

            EndpointURL --: http://localhost:8000/api/assets/updateasset/{asset_serialNumber} <br><br>

                Example --: http://localhost:8000/api/assets/updateasset/hdh76Ryv0H87dyuYE67<br><br>

                Fields content which includes the following listed below are to be passed with the PUT  method to the Endpoint URL.<br>
                string('token')             Required;<br><br>

                {Fields -> value} contents are to be PUT to the Endpoint URL.<br><br>

                Only selected fields to be updated can be PUT to request payload.

                <br><br>Possible Errors are returned if encountered<br><br>

                Clients must to accept JSON data at their header configuration as payload is accepted in JSON<br><br><br>


        <h4> 2.5 CRUD API Documentation to DELETE/delete an existing Asset records by Serial Number as key </h4>
            
            EndpointURL --: http://localhost:8000/api/assets/removeasset/{asset_serialNumber}<br><br>
            
                Example --: http://localhost:8000/api/assets/removeasset/7jhrfyui7egHHGI7KKGyG<br><br>

                Fields content which includes the following listed below are to be passed with the DELETE  method to the Endpoint URL.<br>
                string('token')             Required;<br><br>
                
                Asset Records of specified Serial Number at the Endpoint URL will be deleted immediately.<br><br><br>




        <h4> 3.1 CRUD API Documentation to GET/retrieve all vendors in the server </h4>

            EndpointURL --: http://localhost:8000/api/vendors/allvendors<br><br>

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 3.2 CRUD API Documentation to GET/retrieve unique vendor by vendor_id Number only </h4>

            EndpointURL --: http://localhost:8000/api/vendors/uniquevendor/{vendor_id} <br><br>

                Example --: http://localhost:8000/api/vendors/uniquevendor/5<br><br><br>

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 3.3 CRUD API Documentation to POST/create/register a new Vendor </h4>

            EndpointURL --: http://localhost:8000/api/vendors/newvendor<br><br>

                Fields content which includes the following listed below are to be POSTed to the Endpoint URL.
                    <br> string('name')                      Required;
                    <br> string('category')                  Required;
                    <br>string('token')                      Required;

                <br><br>Possible Errors are returned if encountered<br><br>

                Requesting clients must accept JSON data at their header configuration<br><br><br>


        <h4> 3.4 CRUD API Documentation to PUT/update a registered vendor's records by using ID as key </h4>

            EndpointURL --: http://localhost:8000/api/vendors/updatevendor/{vendor_id} <br><br>

                Example --: http://localhost:8000/api/vendors/updatevendor/10<br><br>

            Fields content which includes the following listed below are to be passed with the PUT method to the Endpoint URL.<br>
            string('token')             Required;<br><br>

                {Fields -> value} contents are to be PUT to the Endpoint URL.<br><br>

                Only selected fields to be updated can be PUT to request payload.

                <br><br>Possible Errors are returned if encountered<br><br>

                Clients must to accept JSON data at their header configuration<br><br><br>


        <h4> 3.5 CRUD API Documentation to DELETE/delete an existing Vendor's record by ID as key </h4>

            EndpointURL --: http://localhost:8000/api/vendors/removevendor/{vendor_id} <br><br>

                Example --: http://localhost:8000/api/vendors/removevendor/15<br><br>

            Fields content which includes the following listed below are to be passed with the DELETE method to the Endpoint URL.<br>
            string('token')             Required;<br><br>

                Asset Records of specified Vendor's ID at the Endpoint URL will be deleted immediately.<br><br><br>




        <h4> 4.1 CRUD API Documentation to GET/retrieve all Assets Assignments in the server </h4>

            EndpointURL --: http://localhost:8000/api/assetassignments/allassetassignments<br><br>

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 4.2 CRUD API Documentation to GET/retrieve unique Asset Assignment by ID Number only </h4>

            EndpointURL --: http://localhost:8000/api/assetassignments/uniqueassetassignment/{assetassignment_id} <br><br>

                Example --: http://localhost:8000/api/assetassignments/uniqueassetassignment/23

            Fields content which includes the following listed below are to be passed with the GET method to the Endpoint URL.<br>
            string('token')             Required;<br><br><br>


        <h4> 4.3 CRUD API Documentation to POST/create/register a new Asset Assignment </h4>

            EndpointURL --: http://localhost:8000/api/assetassignments/newassetassignment<br><br>

                Fields content which includes the following listed below are to be POSTed to the Endpoint URL.
                    <br> string('assetId')                       Required;
                    <br> string('assignmentDate')                Optional;
                    <br> string('status')                        Optional;
                    <br> string('isDue')                         Optional;
                    <br> string('dueDate')                       Optional;
                    <br> string('assignedUserId')                Required;
                    <br> string('assignedBy')                    Required;
                    <br>string('token')                          Required;
                    
                <br><br>Possible Errors are returned if encountered

                Requesting clients must accept JSON data at their header configuration<br><br><br>


        <h4> 4.4 CRUD API Documentation to PUT/update a registered Asset Assignment records by using ID as key </h4>

            EndpointURL --: http://localhost:8000/api/assetassignments/updateassetassignment/{assetassignment_id} <br><br>

                Example --: http://localhost:8000/api/assetassignments/updateassetassignment/45<br><br>

                {Fields -> value} contents are to be PUT to the Endpoint URL.<br><br>

                Fields content which includes the following listed below are to be passed with the PUT method to the Endpoint URL.<br>
                string('token')             Required;<br><br>

                Only selected fields to be updated can be PUT to request payload.

                <br><br>Possible Errors are returned if encountered<br><br>

                Clients must to accept JSON data at their header configuration <br><br><br>


        <h4> 4.5 CRUD API Documentation to DELETE/delete an existing Vendor's record by ID as key </h4>

            EndpointURL --: http://localhost:8000/api/assetassignments/removeassetassignment/{assetassignment_id} <br><br>

                Example --: http://localhost:8000/api/assetassignments/removeassetassignment/87<br><br>

                Fields content which includes the following listed below are to be passed with the DELETE method to the Endpoint URL.<br>
    
                string('token')             Required;<br><br>
    
                Asset Records of specified Vender's ID at the Endpoint URL will be deleted immediately.<br><br><br>    
        </blockquote>
    </div>
</body>
</html>

      