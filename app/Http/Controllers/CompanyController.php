<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthorizesRequests;
    public function index(Request $request)
    {
        //Check authorization
        // $this->authorize('viewAny', Company::class);

        FacadesGate::authorize('viewAny', Company::class);
        // Start building the query
        $query = Company::with('assignedTo');

        // filter by role - Sales reps only see their companies
        if (! in_array(auth()->user()->role, ['manager', 'admin'])) {
            $query->where('user_id', auth()->user()->id);
        }

//        Search  functionality

        if ($request->filled('search')) {
            $query->search($request->search);
        }

//        Filter by industry

        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        // Filter by assigned user (for admins / managers)
        if ($request->filled('user_id') && in_array(auth()->user()->role, ['manager', 'admin'])) {

            $query->where('user_id', $request->user()->id);
        }

        // Get companies with pagination
        $companies = $query->latest()->paginate(15)->withQueryString();

        // Get all industries for filter dropdown

        $industries = Company::search('industry')
            ->distinct()
            ->whereNotNull('industry')
            ->orderBy('industry')
            ->pluck('industry');

        // Get all users for filter dropdown(only for admins /managers)
        $users = in_array(auth()->user()->role, ['manager', 'admin'])
            ? User::orderBy('name')->get()
            : collect();

        return view('companies.index', compact('companies', 'industries', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check authorization
        // $this->authorize('create', Company::class);

        FacadesGate::authorize('create', Company::class);

        // Get all the users for the "Assign to Dropdown
        // Only admins and managers can assign to others

        if (in_array(auth()->user()->role, ['manager', 'admin'])) {

            $users = User::orderBy('name')->get();
        } else {
            $users = collect([auth()->user()]);

        }

        return view('companies.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        // Data is alrady validated by StoreCompany Request
        $company = Company::create($request->validated());

        return redirect()->route('companies.show', $company)->with('success', 'Company created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //     //Check authorization
           FacadesGate::authorize('view', $company);

        // Load relationships
        // $company->load('assignedTo');

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        // $this->authorize('edit', $company);

        FacadesGate::authorize('update', $company);

        // Check if user can reassign companies

        $canReassign = auth()->user()->can('reassign', Company::class);

        // Get users for dropdown

        $users = $canReassign ? User::orderBy('name')->get() : collect([auth()->user()]);

        return view('companies.edit', compact('company', 'canReassign', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        // Data is already validated and authorized by UpdateCompanyRequest
        $company->update($request->validated());

        return redirect()
            ->route('companies.index', $company)
            ->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Check authorization
        $this->authorize('delete', $company);

        // Soft delete the company
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company deleted successfully!');
    }
    public function trash()
    {
        // Only admins and managers can view trash
        if (! in_array(auth()->user()->role, ['admin', 'manager'])) {
            abort(403, 'Unauthorized action.');
        }

        $companies = Company::onlyTrashed()
            ->with('assignedTo')
            ->latest('deleted_at')
            ->paginate(15);

        return view('companies.trash', compact('companies'));
    }

    /**
     * Restore a soft-deleted company
     *
     * URL: /companies/{id}/restore
     * Method: POST
     */
    public function restore($id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);

        // Check authorization
        $this->authorize('restore', $company);

        $company->restore();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company restored successfully!');
    }

    /**
     * Permanently delete a company
     *
     * URL: /companies/{id}/force-delete
     * Method: DELETE
     */
    public function forceDelete($id)
    {
        $company = Company::onlyTrashed()->findOrFail($id);

        // Check authorization
        $this->authorize('forceDelete', $company);

        $company->forceDelete();

        return redirect()
            ->route('companies.trash')
            ->with('success', 'Company permanently deleted!');
    }

}
