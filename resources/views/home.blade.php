<x-app-layout>
    <x-slot name="header">

        <div class="card mb-3 user">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{Auth::user()->url_img}}" class="card-img-top img_user" alt="usuario">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><b>My name:</b> {{ Auth::user()->name }}</h4>
                    <h5 class="card-title"><b>My email:</b> {{ Auth::user()->email }}</h5>
                    <h5 class="card-title"><b>Reserves total: </b>{{$nbooks}}</h5>
                </div>
              </div>
            </div>
          </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="container">
                        <div class="title_reserve">
                            <b>My Reserves</b>
                        </div>
                    </div>
                    <hr>

                    @if (session('status'))
                        <div class="alert alert-success w-50 p-3" role="alert">
                            {{session('status')}}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="books" class="table table-sm  table-bordered table-hover table-striped mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">N. Pag</th>
                                    <th scope="col">Date delivery</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->pag}}</td>
                                    <td>{{$book->date_delivery}}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm text-right cancelar" data-bs-toggle="modal" data-bs-target="#modal{{$book->id}}">
                                            Delete
                                          </button>

                                          <!-- Modal Reservar -->
                                          <div class="modal fade" id="modal{{$book->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <div class="modal-content ">
                                                    <div class="modal-body">
                                                        <center><img class="img_danger" src="img/danger.png" alt=""></center>
                                                        <h3><b>you want to remove the booking from the book: </b></h3>
                                                        <h3>{{$book->title}}?</h3>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                                                        {{--  <button type="button" class="btn btn-danger reserve">Delete</button>  --}}
                                                        <form action="{{route('homes.destroy',$book->id)}}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                              </div>
                                            </div>
                                          </div>

                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
