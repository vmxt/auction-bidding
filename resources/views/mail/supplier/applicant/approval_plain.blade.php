Dear {{ $supplier->username }},

We're proud to inform you that your supplier accreditation has passed our first screening process. Inorder to proceed to next step, we need you to fillup our Supplier Information Sheet by clicking the following link:

{{ env('APP_URL') }}/sp/login

Use the following account as your login data. You may change this password after login.

Username: {{$supplier->email}}
Password: {{$pass}}

Thank you.


Regards,
Philsaga



