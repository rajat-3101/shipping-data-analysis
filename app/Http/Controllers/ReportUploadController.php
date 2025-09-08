<?php
namespace App\Http\Controllers;

use App\Models\NoonReport;
use App\Models\ReportType;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Flasher\Toastr\Prime\ToastrInterface;


class ReportUploadController extends Controller
{
    public function create(Request $request)
    {
        $vessels        = \App\Models\Vessel::all();
        $voyages        = [];
        $selectedVessel = $request->input('vessel_id');
        if ($selectedVessel) {
            $voyages = \App\Models\Voyage::where('vessel_id', $selectedVessel)->get();
        }
        $reportTypes = ReportType::all();
        return view('report_upload.create', compact('vessels', 'voyages', 'reportTypes', 'selectedVessel'));
    }

    public function store(Request $request)
    {
        // dd("here",$request->all());
        $request->validate([
            'report_file' => 'required|file|mimes:csv,xlsx,xls',
        ]);

        // Handle file upload
        $file      = $request->file('report_file');
        $extension = $file->getClientOriginalExtension();
        // dd($file, $extension);
        $data = [];
        if ($extension === 'csv') {
            $handle = fopen($file->getRealPath(), 'r');
            $header = fgetcsv($handle);
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = array_combine($header, $row);
            }
            fclose($handle);
        } else {
            // For Excel files
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet       = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $header      = array_shift($sheet);

            foreach ($sheet as $row) {
                $data[] = array_combine($header, $row);
            }
        }
        // dd($data);
        // Store data in noon_reports table
        foreach ($data as $row) {
            // dd($row['Log Distance(NM)']);
            // dd(Carbon::parse($row['ETA Destination Port'])->format('y-m-d H:i'));
            $saveNoonReport = NoonReport::create([
                'report_date'                               => $request->input('report_date'),
                'created_by'                                => auth()->id(),
                'vessel_id'                                 => $request->input('vessel_id'),
                'voyage_id'                                 => $request->input('voyage_id'),
                'report_type_id'                            => $request->input('report_type_id'),
                'voyage_comes_under'                        => $row['Voyage Comes Under'] ?? null,
                'utc_time'                                 => Carbon::parse($row['UTC Time'])->format('y-m-d H:i') ?? null,
                'time_correction'                           => $row['Time Correction'] ?? null,
                'position_lat'                              => $row['Latitude'] ?? null,
                'position_long'                             => $row['Longitude'] ?? null,
                'vessel_movement'                           => $row['Vessel Movement'] ?? null,
                'observed_distance_since_last_noon_report'  => $row['Observed Distance Since Last Noon Report (NM)'] ?? null,
                'log_distance'                              => $row['Log Distance(NM)'] ?? null,
                'engine_distance'                           => $row['Engine Distance (NM)'] ?? null,
                'sog_slip'                                  => $row['SOG Slip'] ?? null,
                'log_slip'                                  => $row['Log Slip'] ?? null,
                'total_steaming_hours_since_faop'           => $row['Total Steaming Hours Since FAOP'] ?? null,
                'total_distance_since_faop'                 => $row['Total Distance Since FAOP'] ?? null,
                'distance_to_destination_port'              => $row['Distance to Destination Port'] ?? null,
                'avg_speed_since_last_noon_report_sog'      => $row['Avg Speed Since Last Noon Report SOG'] ?? null,
                'avg_speed_since_last_noon_report_log'      => $row['Avg Speed Since Noon Report (Log) (knots)'] ?? null,
                'average_engine_rpm_since_last_noon_report' => $row['Avg RPM Since Last Noon Report'] ?? null,
                'avg_rpm_since_faop'                        => $row['Avg RPM Since FAOP'] ?? null,
                'engine_power'                              => $row['Engine Power (KW)'] ?? null,
                'engine_torque'                             => $row['Engine Torque'] ?? null,
                'seawater_temp'                             => $row['Seawater Temp'] ?? null,
                'atmosphere_temp'                           => $row['Atmosphere Temp'] ?? null,
                'wind_direction'                            => $row['Wind Direction'] ?? null,
                'wind_relative_direction'                   => $row['Wind Relative Direction'] ?? null,
                'wind_speed_knots'                          => $row['Wind Speed Knots'] ?? null,
                'sea_direction'                             => $row['Sea Direction'] ?? null,
                'sea_state'                                 => $row['Sea State'] ?? null,
                'beaufort_force'                            => $row['Beaufort Force'] ?? null,

                'me_hfo'                                    => $row['ME HFO'] ?? null,
                'me_lfo'                                    => $row['ME LFO'] ?? null,
                'me_vlsfo'                                  => $row['ME VLSFO'] ?? null,
                'me_mdo_mgo'                                => $row['ME MDO/MGO'] ?? null,

                'ae_hfo'                                    => $row['AE HFO'] ?? null,
                'ae_lfo'                                    => $row['AE LFO'] ?? null,
                'ae_vlsfo'                                  => $row['AE VLSFO'] ?? null,
                'ae_mdo_mgo'                                => $row['AE MDO/MGO'] ?? null,

                'boiler_hfo'                                => $row['Boiler HFO'] ?? null,
                'boiler_lfo'                                => $row['Boiler LFO'] ?? null,
                'boiler_vlsfo'                              => $row['Boiler VLSFO'] ?? null,
                'boiler_mdo_mgo'                            => $row['Boiler MDO/MGO'],

                'eta_final_destination'                     => Carbon::parse($row['ETA Destination Port'])->format('y-m-d H:i')?? null,
                'deviations'                                => $row['Deviations'] ?? null,
                'remarks'                                   => $row['Remarks'] ?? null,

            ]);
        }
        toastr()->success('Noon report uploaded successfully.');
        // Display a success toast with no title
        // toastr()->error('Operation completed successfully.');
        // return redirect()->back();
        return redirect()->route('noon-report.index');
    }

    public function getVoyages(Request $request)
    {
        $vesselId = $request->input('vessel_id');
        $voyages  = [];
        if ($vesselId) {
            $voyages = \App\Models\Voyage::where('vessel_id', $vesselId)->get(['id', 'voyage_name']);
        }
        return response()->json($voyages);
    }

}
