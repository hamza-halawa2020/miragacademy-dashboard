Hello Admin,

You received a new message from the contact form on {{ config('app.name') }}.

CONTACT DETAILS
---------------
Sender Name: {{ $contact->name }}
Phone: {{ $contact->phone }}
Email: {{ $contact->email }}
Age: {{ $contact->age }}
Country: {{ $contact->country }}
Interested Course: {{ $contact->course }}
Submitted At: {{ $contact->created_at?->toDateTimeString() }}

Message Content:
{{ $contact->message }}

Dashboard: {{ url('/admin/contacts') }}
