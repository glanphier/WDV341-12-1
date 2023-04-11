
<?php 
require 'dbConnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>WDV341 | Form Page for Events</title>
    <style>
        h1, h2 {
            text-align: center;
        }
        header {
            margin-left: -12px;
            margin-right: -12px;
        }
        #body-container-main {
            margin-top: -8px;
        }
        textarea {
            resize: none;
        }
        #email {
            display: none;
        }
        .bg {
            background-color: rgb(95, 242, 184);
        }
    </style>
    <script>
        function resetConfirmation() {
            document.querySelector('#confirmation').innerHTML = '';
        }

    </script>
    
   
</head>
<body class='bg-light'>
    <div class="bg">
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['email'] == null) {
        $fname = $_POST['fname'];
        $fdescription = $_POST['fdescription'];;
        $fpresenter = $_POST['fpresenter'];;
        $fdate = $_POST['fdate'];
        $ftime = $_POST['ftime'];
        $dateInserted = date("Y-m-d");
    
        
        if ($fname != null && $fdescription != null && $fpresenter != null && $fdate != null && $ftime != null) {
    
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO wdv341_events (name, presenter, description, date, time, date_inserted)
             VALUES (:fname, :fpresenter, :fdescription, :fdate, :ftime, :dateInserted)";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':fpresenter', $fpresenter);		
            $stmt->bindParam(':fdescription', $fdescription);		
            $stmt->bindParam(':fdate', $fdate);
            $stmt->bindParam(':ftime', $ftime);
            $stmt->bindParam(':dateInserted', $dateInserted);
                    
    
            
            $stmt->execute(); 

            echo "
            <div class='bg-success shadow-sm' id='confirmation'>
            <p style='text-align:center; color:white'>Class successfully entered to database!</p>
            </div>'
            
            ";
    
        } else {
            echo "
            <div style='background-color: red' class='shadow-sm' id='confirmation'>
            <p style='text-align:center'>Error submitting class, make sure that you filled out all fields!</p>
            </div>'
            
            ";
        }
    
    }
    ?>
        <div class="container">
            <div class="container-fluid">
                <h1>WDV341 Intro PHP</h1>
                <h2>12-1: Create a Form Page for the Events</h2>
                <br>
            </div>
        </div>
    </div>
        
        <div class="container shadow-sm bg-white rounded-bottom" id="body-container-main">
        <h3></h3> 
        <br>
        <div class="container" id="form-container">
            <div class="row">
            <div class="col-6">
            <form name="form1" id="form-1" method="post" action="selfPostingForm.php">
                <div class="row">
                    <div class="col s12 m5">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="fname">Course Name*</label>
                                <br>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="Name" />
                                <span id="name_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <input type="text" class="email" id="email" name="email" />
                                <div class="form-group">
                                <label for="fpresenter">Presenter*</label> 
                                <br>
                                <input type="text" class="form-control" name="fpresenter" id="fpresenter" placeholder="Presenter" />
                                <span id="presenter_error"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <label for="fdate">Date*</label> 
                                <br>
                                <input type="date" class="form-control" name="fdate" id="fdate" />
                                <span id="date_error"></span>
                            </div>
                            <div class="col-6">
                                <label for="ftime">Time*</label> 
                                <br>
                                <input type="time" class="form-control" name="ftime" id="ftime" />
                                <span id="time_error"></span>
                            </div>
                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fdescription">Course Description*</label>
                                    <br>
                                    <textarea class="form-control" name="fdescription" id="fdescription" rows="3" placeholder="Add a description here..."></textarea>
                                    <span id="description_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <div class="col-4" style="align-items: right">
                        <button type="reset" class="btn btn-outline-secondary" onclick="resetConfirmation()">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                <br>
            </form>  
            <br>
            </div>
            <div class="col-6">
                <p style='text-align:center'>Fill out the form and click submit to enter!</p>
            </div>
            </div>
        </div> 
    </div>
</body>
</html>