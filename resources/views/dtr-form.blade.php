<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test DTR Form</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <form class="g-3 m-3" method="GET" action="{{ route('test-time-diff') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Schedule:</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input class="form-control" type="date" name="scheduledDate">
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="time" name="scheduledTimeStart">
                        </div>
                        <div class="col-md-1 text-center">
                            <h6 class="my-2"> to </h6>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="time" name="scheduledTimeEnd">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">Time In:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" type="time" name="timeIn">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="form-label">Time Out:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="form-control" type="time" name="timeOut">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-md">Test DTR</button>
                </div>
            </div>
        </div>
        <hr />
        <h6><span class="text-primary">Schedule:</span> {{ $dtrResults['schedule'] }}</h6>
        <h6><span class="text-primary">Time In:</span> {{ $dtrResults['timeIn'] }}</h6>
        <h6><span class="text-primary">Time Out:</span> {{ $dtrResults['timeOut'] }}</h6>
        <h6><span class="text-primary">Next Day-Out:</span> {{ $dtrResults['nextDayOut'] }}</h6>
        <h6><span class="text-primary">Night Differential:</span> {{ $dtrResults['nightDiff'] }}</h6>
        <h6><span class="text-primary">Night Differential OT:</span> {{ $dtrResults['ND_OT'] }}</h6>
    </form>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>