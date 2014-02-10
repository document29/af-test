@extends('layout')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <Title>Job Applicants Report</title>
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssbase/cssbase-min.css">
        <style type="text/css">
            #page {
                width: 1200px;
                margin: 30px auto;
            }
            .job-applicants {
                width: 100%;
            }
            .job-name {
                text-align: center;
            }
            .applicant-name {
                width: 150px;
            }
        </style>
    </head>
    <body>
        <div id="page">
            <table class="job-applicants">
                <thead>
                    <tr>
                        <th>Job</th>
                        <th>Applicant Name</th>
                        <th>Email Address</th>
                        <th>Website</th>
                        <th>Skills</th>
                        <th>Cover Letter Paragraph</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $job_row)
                    <!-- {{$job_row['name']}}-->
                    <tr>
                        <td rowspan="{{$job_row['rowspan']}}" class="job-name">{{$job_row['name']}}</td>
                        @for($i = 0; $i < count($job_row['applicants']); $i++)
                            @if ($i > 0)
                                <tr>
                            @endif
                            <td rowspan="{{$job_row['applicants'][$i]->skillcount}}" class="applicant-name">{{$job_row['applicants'][$i]->name}}</td>
                            <td rowspan="{{$job_row['applicants'][$i]->skillcount}}"><a href="mailto:{{$job_row['applicants'][$i]->email}}">{{$job_row['applicants'][$i]->email}}</a></td>
                            <td rowspan="{{$job_row['applicants'][$i]->skillcount}}"><a href="{{$job_row['applicants'][$i]->website}}">{{$job_row['applicants'][$i]->website}}</a></td>
                            @if ($job_row['applicants'][$i]->skillcount >= 1)
                                <td>{{$job_row['applicants'][$i]->skills[0]}}</td>
                            @else
                                <td>&nbsp;</td>
                            @endif
                            <td rowspan="{{$job_row['applicants'][$i]->skillcount}}">{{$job_row['applicants'][$i]->cover_letter}}</td>
                            </tr>
                            @for ($j = 1; $j < $job_row['applicants'][$i]->skillcount; $j++)
                                <tr>
                                    <td>{{$job_row['applicants'][$i]->skills[$j]}}</td>
                                </tr>
                            @endfor
                        @endfor
                    </tr>
                @endforeach
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan="6">{{{$footer['applicants']}}} Applicants, {{$footer['skills']}} Unique Skills</td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </body>
</html>
@stop
