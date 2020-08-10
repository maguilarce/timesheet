<h2>Hi, {{ $name }}</h2>
<p>This is an automated email sent from the HCC Online Tutoring Payroll System.<br>Your time entry of <strong>{{$hours}} hour(s)</strong> on <strong>{{$date}}</strong> has been
    @if ($status == 'approved')
        <strong style="color:rgb(3, 91, 3);">{{$status}}.</strong></p>
    @else 
        <strong style="color:red;">{{$status}}.</strong></p>
    @endif 

<p>Please direct any concerns you may have to <a href="mailto:deborah.hardwick@hccs.edu">Deborah Hardwick</a>.</p>

<p>Thanks,</p>

<h4>HCC Online Tutoring Payroll System</h4>