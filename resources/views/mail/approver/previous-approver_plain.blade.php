Dear {{ $user->username }},

Good day!

Please be informed that the supplier you approved {{$supplier->company_name}} has been declined by {{ $current->username }}. In adherence with the best practices on due process, it is advisable for you to have a discussion with {{ $current->username }} and come up with a mutually agreed decision.

{{ route('approver.login') }}

Thank you and hoping for your prompt action on this matter!


Regards,
{{ $setting->company_name }}