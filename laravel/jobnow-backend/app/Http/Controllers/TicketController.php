<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = DB::table('tickets')
        ->select('id', 'title', 'description', 'author_id', 'screenshot_id')
        ->get();

        return response($ticket);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:255',
            'author_id' => 'required'
        ]);

        //TODO: Guardar fichero

        $ticket = Ticket::create($request->all());

        return response($ticket);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $ticket = Ticket::find($id);

        return response($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //TODO: Update fichero

        $ticket = Ticket::find($id)
        ->update($request->all());

        return response($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: Eliminar fichero
        
        Ticket::destroy($id);
        return response(content: "Success. The ticket ${id} has been eliminated");
    }
}
