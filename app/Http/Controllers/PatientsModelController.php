<?php
//namespace App\Api\V1\Controllers;
namespace App\Http\Controllers;
use App\Models\PatientsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PatientsModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = PatientsModel::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $data = $request->only('name', 'email', 'address', 'patient_code');

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:patients_models',
            'address' => 'required',
            'patient_code' => 'required|max:255|unique:patients_models',
        ]);

        if ($validator->fails()) {
            throw new NotFoundHttpException;
        }

        $patient = PatientsModel::create($request->all());

        return response()->json([
            "message" => "Patient record created",
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PatientsModel  $patientsModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (PatientsModel::where('id', $id)->exists()) {
            $student = PatientsModel::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "message" => "Ooops, Patient not found",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PatientsModel  $patientsModel
     * @return \Illuminate\Http\Response
     */

    public function real(Request $request, $id)
    {
        if (PatientsModel::where('id', $id)->exists()) {
            $patient = PatientsModel::find($id);
            $patient->name = is_null($request->name) ? $patient->name : $request->name;
            $patient->email = is_null($request->email) ? $patient->email : $request->email;
            $patient->patient_code = is_null($request->patient_code) ? $patient->patient_code : $request->patient_code;
            $patient->address = is_null($request->address) ? $patient->address : $request->address;
            $patient->save();

            return response()->json([
                'success' => true,
                'message' => 'Patient updated successfully',
                'data' => $patient,
            ], Response::HTTP_OK);

        } else {
            return response()->json([
                "message" => "Patient not found",
            ], 404);

        }
    }

    public function deletePatient($id)
    {

        if (PatientsModel::where('id', $id)->exists()) {
            $student = PatientsModel::find($id);
            $student->delete();

            return response()->json([
                "message" => "records deleted",
            ], 202);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Sorry, Patient not found.',
            ], 400);

        }

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        $article = PatientsModel::findOrFail($id);

        $article->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Patient Information updated successfully',
            'data' => $article,
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PatientsModel  $patientsModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PatientsModel $patientsModel, $id)
    {
        if (!empty($id)) {
            $patient = $patientsModel::find($id);
            if ($patient) {
                $patient->delete();
                return response()->json('Successfully deleted patient', 200);
            } else {
                return response()->json('Sorry that record is not found, try again ...', 201);
            }
        } else {
            return response()->json('Please check your unique indentification properly', 201);
        }
    }
}
