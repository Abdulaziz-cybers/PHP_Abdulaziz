<?php
class Form{
    public function __construct() {
        echo '<head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Work Tracker</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha383-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            </head>

            <body style="background-color:#ffebcd ">
                <div class="col-md-10 text-center">
                    <h1>WORK TIME TRACKER</h1>
                    </div>
    
    <div class="container">
        
        <form method="post" class="form d-flex justify-content-center class=form mt-4 p-3 rounded" style="background-color:coral" >
            <div class="row" >
                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="arrived_at" style="color:aqua">Arrived At:</label> 
                        <input type="datetime-local" class="form-control" id="arrived_at" name="arrived_at" required>
                    </div>
                </div>

                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="leaved_at" style="color:aqua">Leaved At:</label>
                        <input type="datetime-local" class="form-control" id="leaved_at" name="leaved_at" required>
                    </div>
                </div>

                <div class="col-md-3" >
                    <div class="form-group"> 
                        <label for="name" style="color:aqua">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required> 
                    </div>
                </div>
            
                <div class="col-md-3" >
                    <button type="submit" class="btn btn-primary">Yuborish</button>
                </div>
            </div>
        </form>
    </form>';
    }
}