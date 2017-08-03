<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/right-nav-style.css">
<link rel="stylesheet" href="css/index.css">
    <title>Calendar</title>
</head>

<body>

    <div class="container-fluid">
        <input type="checkbox" id="nav-toggle" hidden>

        <nav class="nav">

            <label for="nav-toggle" class="nav-toggle" onclick></label>

            <h2 class="logo">
                <span class="header">Близжайщие события:</span>
            </h2>
            <div class="row eventShower">
            
            </div>
        </nav>
        <?php 
                $y = date('Y');
                for($i = 1;$i <= 12;$i++):?>
        <?php
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $i, $y);
                $offset = date('N',strtotime("{$y}-{$i}-01"));
                $weekName = ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'];
                $monthName = [
                        'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 
                        'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
                    ];
                        ?>
            <?php  if(($i+3)%4==0):?>
            <div class="row">
                <?php endif; ?>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <tr>
                            <?php for($w = 0; $w < 7;$w++):?>
                            <th>
                                <?php echo $weekName[$w];?>
                            </th>
                            <?php  endfor; ?>
                        </tr>
                        <caption>
                            <?php echo $monthName[$i - 1]; ?>
                        </caption>
                        <tr>
                            <?php --$offset;?>
                            <?php for($o = 0; $o < $offset;$o++): ?>
                            <td></td>
                            <?php endfor;?>
                            <?php for($d = 1; $d <= $daysInMonth; $d++):?>
                            <td class="days" data-toggle="modal" data-target="#myModal" data-date="<?php echo $d.'-'.$i.'-'.$y; ?>">
                                <button class="day"><?php echo $d; ?></button>
                            </td>

                            <?php if(($d + $offset)%7==0):?>
                        </tr>
                        <tr>
                            <?php endif; ?>
                            <?php   endfor; ?>

                            <?php for($d = 0;($d + $offset + $daysInMonth) % 7 !=0;$d++):?>
                            <td></td>
                            <?php endfor;?>
                        </tr>
                    </table>
                </div>
                <?php if($i%4 == 0): ?>
            </div>
            <?php endif; ?>
            <?php endfor; ?>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <form method="post" action="index.php">
                    <div class="modal-body">
                       
                        <label for="title">Enter title</label>
                        <input type="text" class="form-control" name="title" id="title" value="" placeholder='"Ann&#39;s birthday" or "Call at the store"'> 
                        <label for="date">Selected date</label>
                        <input type="text" class="form-control" name="date" id="date" value="" disabled>
                        <div class="col-md-12 radios">
                            <label>Chose your Event</label> <br>
                            <select>
                                <option value="0">Party</option>
                                <option value="1">Event</option>
                                <option value="2">Birthday</option>
                            </select>
                        </div>
                        <label for="desc"> Enter your subject</label>
                        <textarea name="desc" class="form-control" name="desc" id="desc" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary saveDate" name="saveDate" data-id>Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>

</html>
