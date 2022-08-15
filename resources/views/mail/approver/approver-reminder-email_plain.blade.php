Dear {{ $user->username }},

Good day!

This is to remind you that your approval still need on this following suppliers.

@foreach($suppliers as $supplier)
    {{ $supplier->approval->supplier_details->company_name }}
@endforeach

{{ route('approver.login') }}

Thank you and hoping for your prompt action on this matter!


Regards,
Philsaga