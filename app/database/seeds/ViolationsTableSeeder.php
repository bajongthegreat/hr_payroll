<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Carbon\Carbon;

class ViolationsTableSeeder extends Seeder {

	public function run()
	{
		
		// Uncomment the below to wipe the table clean before populating
		DB::table('violations')->truncate();
		DB::table('violations_offenses')->truncate();


		$violations = array(
			['id' => 1,
			 'code' => '1.1',
			 'description' => 'Absence without permission on any calendar day including Sunday, whether singly or consecutively, without reasonable excuse, except on legal holdiays and on the employee\'s established rest days, within one year period.',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 2,
			 'code' => '1.2',
			 'description' => 'Unexcused tardiness within one year period.',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 3,
			 'code' => '1.3',
			 'description' => 'Wasting time or loitering during working hours without permission within one year period.',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 4,
			 'code' => '1.4',
			 'description' => 'Abandoning station without permission',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 5,
			 'code' => '2.1',
			 'description' => 'Deliberately slowing down work or restricting output or engaging in sabotage.',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 6,
			 'code' => '2.2.a',
			 'description' => 'Sleeping on the job, within one year period. (Management staff)',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 7,
			 'code' => '2.2.b',
			 'description' => 'Sleeping on the job, within one year period. (Other employees)',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 8,
			 			 'code' => '2.3.a',
			 			 'description' => '(With mitigating circumstances) Insubordination or willful disobedience of reasonable requests of Supervisor or Management staff, including refusal to accept work assignments.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 9,
			 			 'code' => '2.3.b',
			 			 'description' => '(Without mitigating circumstances) Insubordination or willful disobedience of reasonable requests of Supervisor or Management staff, including refusal to accept work assignments.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 10,
			 			 'code' => '2.4',
			 			 'description' => 'Reporting for work while obviously intoxicated or under influence of liquor.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 11,
			 			 'code' => '2.5.a',
			 			 'description' => 'Drinking any alcohol beverages, unless allowed by the Client-Company or Cooperative, within a five-year period. (On client company or cooperative property or premises during working hours)',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 12,
			 			 'code' => '2.5.b',
			 			 'description' => 'Drinking any alcohol beverages, unless allowed by the Client-Company or Cooperative, within a five-year period. (On client company property or premises or on client company\'s time )',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 13,
			 			 'code' => '2.6.a',
			 			 'description' => '(On client-company or cooperative property or premises or during working hours) Immoral behavior to include lascivious action and sexual harassment is defined as any unwelcomed or  uninvited sexual advances, requests for sexual favors and other verbal or physical conduct of sexual nature which unreasonably interfere with the individual\'s performance at work or creates an intimidating, hostile or offensive working environment.',
	
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 14,
			 			 'code' => '2.6.b',
			 			 'description' => 'Immoral behavior to include lascivious action and sexual harassment is defined as any unwelcomed or  uninvited sexual advances, requests for sexual favors and other verbal or physical conduct of sexual nature which unreasonably interfere with the individual\'s performance at work or creates an intimidating, hostile or offensive working environment. (On client-company or cooperative property or premises and on Coop/client company time)',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 15,
			 			 'code' => '2.7.a',
			 			 'description' => 'Gambling to include betting, or collecting bets in raffle or lottery, within a five-year period. (On client-company or cooperative property or premises or during working hours)',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 16,
			 			 'code' => '2.7.b',
			 			 'description' => '(On client-company or cooperative property or premises and on Coop/client company time) Gambling to include betting, or collecting bets in raffle or lottery, within a five-year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 17,
			 			 'code' => '2.8',
			 			 'description' => 'Use of profane or abusive language including spreading of false rumors or malicious statements against co-employee and cooperative itself in general.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 18,
			 			 'code' => '2.9',
			 			 'description' => 'Distributing written or printed matter of any description on Client-company / Coop premises unless specifically authorized by Management / Officers, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 19,
			 			 'code' => '2.10',
			 			 'description' => 'Posting on or removal of any material from bulletin boards on the cliet company\'s / Cooperative\'s property at any time unless specifically authorized by Management, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 20,
			 			 'code' => '2.11.a',
			 			 'description' => '(During working hours and on client company or on Cooperative premises) Fighting or provoking or instigating a fght by fisticuffs, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 21,
			 			 'code' => '2.11.b',
			 			 'description' => '(During working hours and /or on client company or on Cooperative premises, with the use of deadly weapon) Fighting or provoking or instigating a fght by fisticuffs, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 22,
			 			 'code' => '2.12',
			 			 'description' => 'Threatening, intimidating, coercing or interfering with or attempting bodily to or assaulting fellow employees insofar as such actions interfere with working relationship.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 23,
			 			 'code' => '2.13',
			 			 'description' => 'Vending, collecting payments of debts or soliciting or collecting contribution for any purpose whatsoever, at anytime in Client Company\'s Cooperative\'s premises, unless authorized by management, within one year period. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 24,
			 			 'code' => '2.14',
			 			 'description' => 'Formally accused in court for a crime without bail, or sentenced by final judgement to imprisonment for more than six months.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 25,
			 			 'code' => '2.15.a',
			 			 'description' => 'Engaging in horseplay, scuffling or throwing things, while at work or in Client-Company / Cooperative premises, within one year period. (Not resulting in damage to the client company/Cooperative property or injury to others) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 26,
			 			 'code' => '2.15.b',
			 			 'description' => 'Engaging in horseplay, scuffling or throwing things, while at work or in Client-Company / Cooperative premises, within one year period. (Resulting in damage to the client company/Cooperative property or injury to others) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 27,
			 			 'code' => '2.16',
			 			 'description' => 'Deliberately defacing or destroying Client Company/ Cooperative property to include any act of vandalism.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 28,
			 			 'code' => '2.17',
			 			 'description' => 'Possession or use of prohibited drugs during working hours and/or on Client-Company / Cooperative premises.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 29,
			 			 'code' => '2.18',
			 			 'description' => 'Engaging in kickership with Client company\'s regular planters and bringing with them their own kicker planters in the work place within one year period. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 30,
			 			 'code' => '3.1',
			 			 'description' => 'Making false statements or deliberately lying during formal investigation.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 31,
			 			 'code' => '3.2.a',
			 			 'description' => '(With mitigating circumstances) Falsifying and/or misrepresentation of reports or fraudulently altering personnel/working efficiencies or Cooperative records.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 32,
			 			 'code' => '3.2.b',
			 			 'description' => '(Without mitigating circumstances) Falsifying and/or misrepresentation of reports or fraudulently altering personnel/working efficiencies or Cooperative records.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 33,
			 			 'code' => '3.3',
			 			 'description' => 'Falsifying any signature on a Cooperative check/contracts and Daily time reports.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 34,
			 			 'code' => '3.4',
			 			 'description' => 'Knowingly filling daily time report of another employee having, the same records filled in by another employees or unauthorized altering of a time or daily time report or reporting names which are not actually present and padding efficiencies/ payroll.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 35,
			 			 'code' => '3.5',
			 			 'description' => 'Permitting another to use your ID card; using another ID card; altering/tampering ID card.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 36,
			 			 'code' => '3.6.a',
			 			 'description' => '(With mitigating circumstances) Stealing of any sort includng theft or removal from premses, without proper authorization, of any Client-Company/ Cooperative property or property of any employee without latter\'s  consent.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 37,
			 			 'code' => '3.6.b',
			 			 'description' => '(Without mitigating circumstances) Stealing of any sort includng theft or removal from premses, without proper authorization, of any Client-Company/ Cooperative property or property of any employee without latter\'s  consent.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 38,
			 			 'code' => '3.7.a',
			 			 'description' => 'All other acts of dishonesty (With mitigating circumstances)',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 39,
			 			 'code' => '3.7.b',
			 			 'description' => 'All other acts of dishonesty (Without mitigating circumstances)',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 40,
			 			 'code' => '4.1',
			 			 'description' => 'Consistent failure to meet reasonable work standards made known to the employee, even after proper supervision and training and instructions, within a two year period.',
			 			 'created_at' => Carbon::now(),	
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 2
			 ], 
			 ['id' => 41,
			 			 'code' => '4.2.1',
			 			 'description' => '(Negligence) Inexcusable negligence resulting in disruption of operation or impaired work performance, within a five-year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ], 
			 ['id' => 42,
			 			 'code' => '4.2.2',
			 			 'description' => '(Negligence) Mistakes due to carelessness or simple negligence, which affect the safety of personnel or cause machinery or equiptment to be idle or useless, within a one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 43,
			 			 'code' => '4.2.3',
			 			 'description' => '(Negligence) Mistakes due to lack of knowledge (depending on consequences), within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 44,
			 			 'code' => '4.3.1',
			 			 'description' => '(Neglect of duty) Failure to submit daily time record or time sheet, within the time required, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 45,
			 			 'code' => '4.3.2',
			 			 'description' => '(Neglect of duty) Failure to wear ID card, inside the Cooperative - Client-Company premises, within a one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 46,
			 			 'code' => '4.3.3',
			 			 'description' => '(Neglect of duty) Refusal to show or surrender Id card at the reasonable request of any Client Company\'s Representative/Cooperative\'s management staff or other authorized personnel on Cooperative or Client Company premises, within a one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 47,
			 			 'code' => '4.3.4',
			 			 'description' => '(Neglect of duty) Reporting for work or working in not proper and required uniform or without tools, equiptment or devices necessary for the performance of his work, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 48,
			 			 'code' => '4.3.5',
			 			 'description' => '(Neglect of duty) Failure to render overtime work or report for work during rest days or holidays without good reason after being scheduled for work, within a one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 49,
			 			 'code' => '4.3.6.a',
			 			 'description' => '(Neglect of duty) Failure to report loss of, or damage done to, Client Company/Cooperative\'s property within 24 hours without acceptable excuse, within one year period. (Management staff) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 50,
			 			 'code' => '4.3.6.b',
			 			 'description' => '(Neglect of duty) Failure to report loss of, or damage done to, Client Company/Cooperative\'s property within 24 hours without acceptable excuse, within one year period. (Other employees) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 51,
			 			 'code' => '5.1',
			 			 'description' => 'Refusal to show or surrender LTO Driver\'s license or Company driver\'s operator permit or Green card when driving cooperative or client company vehicle at the reasonable request of Cooperative/Client Company management staff or member of the safety department, within one year period.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 52,
			 			 'code' => '5.2',
			 			 'description' => 'Unauthorized possession of firearm, explosives, flammable materials, or deadly weapons within client company/cooperative premises or job sites, at any time.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ], 
			 ['id' => 53,
			 			 'code' => '5.3',
			 			 'description' => 'Smoking within "NO SMOKING" area, including Cooperative/ Company equiptment, service/hauler truck and other vehicles regardless of location of the vehicle or equiptment and whether it is in motion or just being parked. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 54,
			 			 'code' => '5.4.a',
			 			 'description' => 'Using or operating Client Company/Cooperative\'s vehicle, machinery or equiptment to which the employee has not been assigned, or without prior authorization, within five year period. This includes assignee allowing or tolerating another person to use or operate his assigned vehicle, machinery or equiptment. (Not resulting in damage to equiptment parts or materials or injury to self or others.) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 55,
			 			 'code' => '5.4.b',
			 			 'description' => 'Using or operating Client Company/Cooperative\'s vehicle, machinery or equiptment to which the employee has not been assigned, or without prior authorization, within five year period. This includes assignee allowing or tolerating another person to use or operate his assigned vehicle, machinery or equiptment. (resulting in damage to equiptment parts or materials or injury to self or others.) ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 56,
			 			 'code' => '5.5.1',
			 			 'description' => '&lt;b&gt;Creating or contributing to unsanitary conditions or poor housekeeping&lt;/b&gt; &lt;br&gt;  Urinating, splitting or defacating within Client company/ cooperative premises/ facilities.  ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 57,
			 			 'code' => '5.5.2.a',
			 			 'description' => '&lt;b&gt;Creating or contributing to unsanitary conditions or poor housekeeping&lt;/b&gt; &lt;br&gt;  Littering, eating, wearing of jewelry and other ornaments within client company premises/facilities. &lt;br&gt&lt;br&gt; 
			 			                   Within the product preparation areas or research or experimental places of the cooperative or client company where contamination of the product can occur such as: Preparation, Processsing, Warehouse/ Packaging, Packing Plant, Nata de Coco receiving, TFC area and other Production areas. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 58,
			 			 'code' => '5.5.2.b',
			 			 'description' => '&lt;b&gt;Creating or contributing to unsanitary conditions or poor housekeeping&lt;/b&gt; &lt;br&gt;  Littering, eating, wearing of jewelry and other ornaments within client company premises/facilities. &lt;br&gt&lt;br&gt; 
			 			                   Outside of the product preparation or research/expiremental places but within Company/ Cooperative premises/ facilities except for wearing of jewelry and eating in designated areas. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 59,
			 			 'code' => '5.5.3',
			 			 'description' => 'Violation of other GAP & GMP rules not mentioned in paragraph 5.5.1 and 5.5.2',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 5
			 ],
			 ['id' => 60,
			 			 'code' => '5.6',
			 			 'description' => 'Using unauthorized exits and entrances or entering restricted area in the Client\'s premises without specific permission, within one year period. ',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 61,
			 			 'code' => '5.7.a',
			 			 'description' => '&lt;b&gt;Violaton of safety rules and regulations, including traffic safety, within a two-year period.&lt;/b&gt; &lt;br&gt; 
			 			                   Not resulting in damage to Cooperative/Client Company property or injury to self or others.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 2
			 ],
			 ['id' => 62,
			 			 'code' => '5.7.b',
			 			 'description' => '&lt;b&gt;Violaton of safety rules and regulations, including traffic safety, within a two-year period.&lt;/b&gt; &lt;br&gt; 
			 			                   resulting in damage to Cooperative/Client Company property or injury to self or others.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 2
			 ],
			 ['id' => 63,
			 			 'code' => '5.7.c',
			 			 'description' => '&lt;b&gt;Violaton of safety rules and regulations, including traffic safety, within a two-year period.&lt;/b&gt; &lt;br&gt; 
			 			                   If it can be determined that accident was due to gross negligence on the part of the violators, regardless of the amount of damage and extent of injury.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 2
			 ],
			 ['id' => 64,
			 			 'code' => '6.1',
			 			 'description' => 'Abuse or taking advantage of position or authority for personal gain, to incude soliciting and or receiving, whether directly or indirectly, any gift, present or other valuable thing when such is beyond those allowed by the Client-Company / Cooperative guidelines. Hence, gang coordinators, who are receiving daily rate are disallowed to work in their respective field of assignments.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 65,
			 			 'code' => '6.2',
			 			 'description' => 'False or malicious statement or report against the Client-Company / Cooperative and its staff/ officers or its products/services.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 66,
			 			 'code' => '6.3',
			 			 'description' => 'Releasing classified information as defined by Cooperative Policy to unauthorized parties.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 67,
			 			 'code' => '6.4',
			 			 'description' => 'Violation of Conflict of interest policy of the cooperative.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 68,
			 			 'code' => '6.5',
			 			 'description' => 'Entering into a contract or committing the cooperative\'s funds or property beyond the employee\'s authority.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 69,
			 			 'code' => '6.6',
			 			 'description' => 'Providing incorrect or dishonest response or responses to questionnaires on Code of Conduct.',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ],
			 ['id' => 70,
			 			 'code' => 'XI',
			 			 'description' => '&lt;strong&gt;VIOLATION OF A PARTICULAR COOPERATIVE/ CLIENT COMPANY POLICY, RULE OR REGULATIONS, within a one year period.&lt;/strong&gt;',
			 			 'created_at' => Carbon::now(),
			 			 'updated_at' => Carbon::now(), 'period_before_reset' => 1
			 ]
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 			 

		);

		$offenses = [

					 [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 1,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 1,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 1,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 1,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 1,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ======================================== 2
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 2,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 2,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 2,
			           'violation_id' => 2,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 2,
			           'violation_id' => 2,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => 2,
			           'violation_id' => 2,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ========================== 3
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 3,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 3,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 3,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ====================== 4
			         			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 4,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 4,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 4,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============= 5

			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 5,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============= 6

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 6,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 6,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============= 7

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 7,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 7,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 7,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 8

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 8,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 8,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],//============== 9
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 9,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============= 10

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 10,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' =>10,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 10,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 11

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 11,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' =>11,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 11,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 12
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' =>12,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 12,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 13 (2.6 a)

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 13,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' =>13,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 13,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 14 (2.6 b)

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' =>14,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 14,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 15 (2.7 a)

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 15,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' =>15,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 15,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 16 (2.7 b)

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' =>16,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 16,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 17 (2.8 a)

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 17,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],

			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' =>17,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 17,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============ 18
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 18,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // ============ 19
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 19,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 19,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 19,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 19,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 19,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 20 2.11

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' =>20,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 20,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 21

			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 21,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 22
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 22,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 22,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 22,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// ============= 23 2.13

			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' =>23,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 23,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 2.14
					 [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 24,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 24,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 24,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 24,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 24,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// 2.15
					 [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 25,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 25,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 25,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 25,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 25,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// 2.15 b
					 [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 26,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 26,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 26,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 26,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 26,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 27,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 27,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 27,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// 12 discharge
					[ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 28,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 28,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],// 2.18
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 29,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 30,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 30,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 30,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], //3.2
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 31,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 31,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 31,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 31,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.2 b
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 32,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 32,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 32,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 32,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.3
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 33,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.4
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 34,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.5
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 35,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.6
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 16,
			           'violation_id' => 36,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 36,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.6 b
			          [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 37,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.7.a, // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 38,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 38,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 38,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 3.7.a, // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 39,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 39,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 39,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.1
			          [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 40,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 40,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 40,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 40,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 40,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.2.1 // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 41,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 41,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 41,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.2.2 
			          [ 'offense_number' => 1,
			           'days_of_suspension' => 1,
			           'violation_id' => 42,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 42,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 42,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 42,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 42,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.2.3
			          [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 43,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 43,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 3,
			           'violation_id' => 43,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 43,
			           'punishment_type' => 'demotion',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.3 					     					     					     					     				         
			          [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 44,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 44,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 3,
			           'violation_id' => 44,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 6,
			           'violation_id' => 44,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => 12,
			           'violation_id' => 44,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 6,
			           'days_of_suspension' => NULL,
			           'violation_id' => 44,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], //4.3.2
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 45,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 45,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 3,
			           'violation_id' => 45,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 6,
			           'violation_id' => 45,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => 12,
			           'violation_id' => 45,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 6,
			           'days_of_suspension' => NULL,
			           'violation_id' => 45,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge // 4.3.3
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 46,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 46,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 46,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 46,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.3.4 
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 47,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 47,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 3,
			           'violation_id' => 47,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 6,
			           'violation_id' => 47,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => 12,
			           'violation_id' => 47,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 6,
			           'days_of_suspension' => NULL,
			           'violation_id' => 47,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.3.5 
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 1,
			           'violation_id' => 48,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 48,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 48,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 48,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 48,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 49,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 49,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 49,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 4.3.6 b
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 50,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 50,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 50,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 50,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.2
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 52,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 53,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 53,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 53,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6, 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 6,
			           'violation_id' => 54,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 12,
			           'violation_id' => 54,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => NULL,
			           'violation_id' => 54,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 55,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 55,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 56,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 56,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.5.2
			         // [ 'offense_number' => 1,
			         //   'days_of_suspension' => NULL,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'warning',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ],
			         // [ 'offense_number' => 2,
			         //   'days_of_suspension' => 1,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'suspended',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ],
			         // [ 'offense_number' => 3,
			         //   'days_of_suspension' => 3,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'suspended',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ],
			         // [ 'offense_number' => 4,
			         //   'days_of_suspension' => 6,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'suspended',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ],
			         // [ 'offense_number' => 5,
			         //   'days_of_suspension' => 12,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'suspended',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ],
			         // [ 'offense_number' => 6,
			         //   'days_of_suspension' => NULL,
			         //   'violation_id' => 57,
			         //   'punishment_type' => 'discharged',
			         //   'created_at' => Carbon::now(),
			         //   'updated_at' => Carbon::now()
			         // ], // 12, discharge
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 57,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 57,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.5.2.b
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 58,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 58,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 58,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 58,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.5.3
			          [ 'offense_number' => 1,
			           'days_of_suspension' => 1,
			           'violation_id' => 59,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 59,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 59,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 59,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 59,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			       	], // 5.6 ,
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 60,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 60,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 60,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 60,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			       	], // 5.7
			       	 [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 61,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 3,
			           'violation_id' => 61,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 6,
			           'violation_id' => 61,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 12,
			           'violation_id' => 61,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => NULL,
			           'violation_id' => 61,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.7.b// 12 discharge
					[ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 62,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 62,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 5.7.c
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 63,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6.1
			         // 12 discharge
					[ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 64,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 64,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6.2
			         [ 'offense_number' => 1,
			           'days_of_suspension' => 3,
			           'violation_id' => 65,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 65,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 65,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 65,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6.3 // 12 discharge
					[ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 66,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 66,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], //6.4
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 67,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], //6.5
			         // 12 discharge
					[ 'offense_number' => 1,
			           'days_of_suspension' => 12,
			           'violation_id' => 68,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => NULL,
			           'violation_id' => 68,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // 6.6 
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 69,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 6,
			           'violation_id' => 69,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 12,
			           'violation_id' => 69,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => NULL,
			           'violation_id' => 69,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ], // XI 
			         [ 'offense_number' => 1,
			           'days_of_suspension' => NULL,
			           'violation_id' => 70,
			           'punishment_type' => 'warning',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 2,
			           'days_of_suspension' => 1,
			           'violation_id' => 70,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 3,
			           'days_of_suspension' => 3,
			           'violation_id' => 70,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 4,
			           'days_of_suspension' => 6,
			           'violation_id' => 70,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 5,
			           'days_of_suspension' => 12,
			           'violation_id' => 70,
			           'punishment_type' => 'suspended',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ],
			         [ 'offense_number' => 6,
			           'days_of_suspension' => NULL,
			           'violation_id' => 70,
			           'punishment_type' => 'discharged',
			           'created_at' => Carbon::now(),
			           'updated_at' => Carbon::now()
			         ]



			         ];

		// Uncomment the below to run the seeder
		DB::table('violations')->insert($violations);
		DB::table('violations_offenses')->insert($offenses);
	}

}