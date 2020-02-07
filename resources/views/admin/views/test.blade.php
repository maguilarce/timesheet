@foreach ($tutors as $tutor )
    {{ $tutor->user_id." ".$tutor->date." ".$tutor->quantity }} <br>
@endforeach

@foreach ($tutor_info as $tutor )
     <p>{{$tutor->first_name}}</p>
     <p>{{$tutor->last_name}}</p>
     <p>{{$tutor->email}}</p>
@endforeach





@foreach ($tutor_info as $tutor )
                            <p><b>Tutor: </b>{{$tutor->first_name." ".$tutor->last_name}}</p>
                            <p><b>Tutor ID: </b>{{$tutor->user_id}}</p>
                            <p><b>Tutor Time From: </b>{{$date_from}}</p>
    
                       @endforeach


