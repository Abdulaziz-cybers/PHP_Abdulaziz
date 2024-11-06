<?php
class Form{
    public function render() {
        echo '<form method="post" class="form d-flex justify-content-center" class="form border-radius:15px" style="background-color:coral" >
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