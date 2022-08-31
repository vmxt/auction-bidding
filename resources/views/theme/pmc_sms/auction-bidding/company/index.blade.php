@extends('theme.pmc_sms.main.main')
@section('content')
    @include('partials.page-title', [
        'title' => 'Manage Company Profile',
        'subtitle' => 'A Short Page Title Tagline'
    ])

    <section id="content">
        <div class="content-wrap">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button type="button" id="calories-trigger" class="btn btn-secondary valid">Filter</button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <div class="input-group w-auto me-3">
                            <span class="input-group-text">
                                <i class="icon-line-search"></i>
                            </span>
                            <input type="text" id="icons-filter" class="form-control" value="">
                        </div>
                        
                        <a href="{{ route('company.create') }}" name="fitness-form-submit" class="btn btn-success">Create a Company</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr class="text-nowrap">
                                <th>Company Name</th>
                                <th>Date Registered <span class="small"><small>(dd-mmm-yyyy)</small></span></th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ date('j-M-Y', strtotime($company->created_at)) }}</td>
                                <td>
                                    <div class="badge {{ $company->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($company->status) }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('company.edit', $company->id) }}"><i class="icon-pencil2"></i></a>
                                    <a href="{{ route('company.show', $company->id) }}"><i class="icon-line-eye"></i></a>
                                    <a 
                                        href="{{ route('company.destroy', $company->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $company->id }}').submit();">
                                        <i class="icon-remove"></i>
                                    </a>
                                    <form id="delete-form-{{ $company->id }}" action="{{ route('company.destroy', $company->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>                                                                    
                                </td>
                            </tr>
                            @empty
                                <tr><p>No companies available.</p></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $companies->links() }}
            </div>
        </div>
    </section>
@endsection