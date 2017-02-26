@extends('layouts.master')

<!-- Author form to add authors associated with research papers and posters -->


@section('content')
<div class="content">

	<h3 class="bold">Coaching in Leadership and Healthcare 2017 Submissions</h3>

	<p>Thank you for your research submission(s) for consideration in the Coaching in Leadership and Healthcare 2017 conference, scheduled October 13-14, 2017.
	Your submission is listed below. To make changes to your submission, select the radio button next to your entry and click the "Edit" button below.</p>

		@if(count($errors)  > 0)
		  <ul>
		      @foreach ($errors->all() as $error)
		        <li>{{ $error }}</li>
		      @endforeach
		  </ul>
		@endif

		@if(Session::get('message') != null)
					 <div class='flash_message'>{{ Session::get('message') }}</div>
			 @endif

		<!-- Form to gather user data -->

		<br>
				<form method="POST" id="research_form" action="/research/show">

				<!-- CSRF token for safety -->

				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >


		<br>
	  			@for ($i = 0; $i < $count; $i++)
							<fieldset>
								<legend><span class="bold"><input type="radio" name="research_id" value=" {{ $researches[$i]->id  }}  " >&nbsp; &nbsp;Select This Research Submission To Edit</span></legend>
												<legend><span class="bold">Research</span></legend>
													<span class="bold">Your submission is for a research:</span> {{ $researches[$i]->type }} <br>
													<br>
													<span class="bold">Track:</span>
													<?php $track = $researches[$i]->track; ?>
																@if ( $track == "Both" )
																  <strong>Both Sessions:</strong> Leadership on October 13 or Healthcare on October 14, 2017
																	@elseif ( $track == "Leadership" )
																	  <strong>Leadership:</strong> Leadership and Organizational Coaching--October 13, 2017
																  @else ( $track == "Health" )
																	  <strong>Health:</strong> Healthcare and Wellbeing Coaching--October 14, 2017
																@endif
																<br><br>
													<span class="bold">Title:</span> {{ $researches[$i]->title }} <br><br>
													<span class="bold">Research Findings:</span> {{ $researches[$i]->research }} <br><br>
											  	<span class="bold">Abstract:</span> {{ $researches[$i]->abstract }} <br><br>
									<br>
															<legend><span class="bold">Authors</span></legend>
																		<span class="bold">Main Author:</span> {{ $user->first }} {{ $user->last }}<br>
																		<br>
																		@for ($n = 0; $n < $researches[$i]->auth_count; $n++)
																		<?php $first = "first" . $n; $last = "last" . $n; ?>
																		<span class="bold">Co-Author:</span> {{ $researches[$i]->$first }} {{ $researches[$i]->$last }}<br>
																		<br>
																		@endfor

													</fieldset>
													<br>
							@endfor

				<input type ="submit" value="EDIT">
				</form>
</div>
@stop
