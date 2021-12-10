@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-block">+ New Customer</a>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Company</th>
          <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($customers as $customer)
          <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->company }}</td>
            <td><a href="{{ route('customers.edit', $customer) }}">[Edit]</a></td>
            <td>
                <a href="{{ route('customers.destroy', $customer) }}" class="remove" data-id="delete-customer-{{ $customer->id }}-form">[Delete]</a>
                <form id="delete-customer-{{ $customer->id }}-form" action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    {{ $customers->links() }}
  </div>
</div>

@endsection
@section('extra-js')
    <script>
        const removeItem = document.querySelectorAll('.remove')
        Array.from(removeItem).forEach(function(element) {
            element.addEventListener('click', function() {
                event.preventDefault()
                const customerId = element.getAttribute('data-id')
                if(!confirm("Are you sure?")) {
                    return false;
                }
                document.getElementById(customerId).submit();
            });
        });
    </script>
@endsection
