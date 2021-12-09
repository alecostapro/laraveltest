@extends('layouts.app')

@section('content')
<div class="row">
  <div class="offset-md-10 col-md-2">
    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-block">+ New Order</a>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Desciption</th>
          <th scope="col">Cost</th>
          <th scope="col">Customer</th>
          <th scope="col">Tag</th>
          <th scope="col" colspan="2" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
          <tr>
            <th scope="row">{{ $order->id }}</th>
            <th scope="row">{{ $order->title }}</th>
            <th scope="row">{{ $order->description }}</th>
            <th scope="row">{{ $order->cost }}</th>
            <td>{{ $order->customer->fullName() }}</td>
            <td>
                @foreach($order->tags as $tag)
                {{ $tag->name }}
                @endforeach
            </td>
            <td><a href="{{ route('orders.edit', $order) }}">[Edit]</a></td>
            <td><span class="remove" style="cursor: pointer" data-id="{{ $order->id }}">[Delete]</span>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    {{ $orders->links() }}
  </div>
</div>

@endsection
@section('extra-js')
<script src="{{ asset('js/app.js') }}"></script>
<script>
const removeItem = document.querySelectorAll('.remove')
    Array.from(removeItem).forEach(function(element) {
        element.addEventListener('click', function() {
            const orderId = element.getAttribute('data-id')
            axios.delete('/orders/' + orderId)
            .then(function (response) {
                window.location.href = "{{ route('orders.index') }}"
            })
            .catch(function (error) {
                console.log(error);
                window.location.href = "{{ route('orders.index') }}"
            });
        })
    })
</script>

@endsection
