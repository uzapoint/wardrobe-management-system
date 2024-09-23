<?php

namespace App\Http\Controllers;

use App\Models\SubClient;
use App\Models\TransponderClient;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SubClientController extends Controller
{
    use ApiResponser;
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of sub-client
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $where = array();

        if ($request->has('transponder_client_id') || $request->has('sub_client_id') || $request->has('default_sub')) {
            if ($request->has('transponder_client_id')) {
                $client = array('sub_clients.transponder_client_id', '=', $request->transponder_client_id);
                $where[count($where)] = $client;
            }
            if ($request->has('sub_client_id')) {
                $subClient = array('sub_client_id', '=', $request->sub_client_id);
                $where[count($where)] = $subClient;
            }
            if ($request->has('default_sub')) {
                $default = array('default_sub', '=', $request->default_sub);
                $where[count($where)] = $default;
            }
            // $sub_clients = SubClient::where($where)    ->get()
            $sub_clients = DB::table('sub_clients')->select('sub_clients.transponder_client_id', 'transponder_clients.organization', 'sub_client_id', 'sub_client_name', 'sub_clients.deleted_at')->where($where)
                ->leftJoin('transponder_clients', 'transponder_clients.transponder_client_id', '=', 'sub_clients.transponder_client_id')
                ->whereNull('sub_clients.deleted_at')
                ->get();
        } else {

            // $sub_clients = SubClient::all();
            $sub_clients = DB::table('sub_clients')->select('sub_clients.transponder_client_id', 'transponder_clients.organization', 'sub_client_id', 'sub_client_name', 'sub_clients.deleted_at')
                ->leftJoin('transponder_clients', 'transponder_clients.transponder_client_id', '=', 'sub_clients.transponder_client_id')
                ->whereNull('sub_clients.deleted_at')
                ->get();
        }
        return $this->successResponse($sub_clients);
    }
    /**
     * Create one new sub-client
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'sub_client_name' => 'required',

        ];
        $this->validate($request, $rules);

        $subClients = SubClient::create($request->all());

        return $this->successResponse($subClients, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one sub-client
     * @return Illuminate\Http\Response
     */
    public function show($client)
    {
        $subClients = SubClient::findOrFail($client);

        return $this->successResponse($subClients);
    }

    /**
     * Update an existing sub-client
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $client)
    {
        $rules = [
            'carrier_name' => 'max:100',
        ];

        $this->validate($request, $rules);

        $subClients = SubClient::findOrFail($client);

        $subClients->fill($request->all());

        if ($subClients->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $subClients->save();

        return $this->successResponse($subClients);
    }


    /**
     * Remove an existing sub-client
     * @return Illuminate\Http\Response
     */
    public function destroy($client)
    {
        $subClients = SubClient::findOrFail($client);

        $subClients->delete();

        return $this->successResponse($subClients);
    }

    //server side rendering
    public function get_sub_clients(Request $request)
    {
        $where = array();
        if ($request->has('transponder_client_id')) {
            $client = array('transponder_client_id', '=', $request->transponder_client_id);
            $where[count($where)] = $client;
        }
        if ($request->has('sub_client_id')) {
            $subClient = array('sub_client_id', '=', $request->sub_client_id);
            $where[count($where)] = $subClient;
        }
        if ($request->has('default_sub')) {
            $default = array('default_sub', '=', $request->default_sub);
            $where[count($where)] = $default;
        }
        $limit = $request->input('length');
        $start = $request->input('start');
        $page_dir = $request->input('order.0.dir');
        $data = array();
        $columns = array(
            0 => 'transponder_client_id',
            1 => 'sub_client_id',

        );
        $order = $columns[$request->input('order.0.column')];
        $total_query = SubClient::where($where);
        $total = $total_query->count();
        if (empty($request->input('search.value'))) {
            $sub_clients_query = SubClient::where($where)->offset($start)->limit($limit)->orderBy($order, $page_dir);
            $sub_clients = $sub_clients_query->get();
            $totalFiltered = $total;
        } else {
            $search = $request->input('search.value');
            $sub_clients_query = DB::table('sub_clients')->select('sub_clients.transponder_client_id', 'transponder_clients.organization', 'sub_client_id', 'sub_client_name', 'sub_clients.deleted_at')->where($where)
                ->leftJoin('transponder_clients', 'transponder_clients.transponder_client_id', '=', 'sub_clients.transponder_client_id')
                ->where(function ($query) use ($search) {
                    $query->Where('transponder_clients.organization', 'LIKE', "%{$search}%")
                        ->orWhere('sub_client_name', 'LIKE', "%{$search}%")
                        ->whereNull("sub_clients.deleted_at");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $page_dir);
            $sub_clients = $sub_clients_query->get();
            $totalFiltered = $sub_clients_query->count();
        }
        if (!empty($sub_clients)) {
            foreach ($sub_clients as $sub_client) {
                $clients = TransponderClient::where('transponder_client_id', $sub_client->transponder_client_id)->first();
                $nestedData['DT_RowId'] = $sub_client->sub_client_id;
                $nestedData['transponder_client_id'] = strtoupper($clients->organization);
                $nestedData['sub_client_id'] = ($sub_client->sub_client_name == 'default') ? "-" : strtoupper($sub_client->sub_client_name);
                $data[] = $nestedData;
            }

            $sub_client_data = [
                "draw" => intval($request->input('draw')),
                "recordsTotal" => intval($total),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data,
            ];
            return $this->successResponse($sub_client_data);
        }
    }
}
