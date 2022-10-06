-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 11:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propose`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `apply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `date_applied` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`apply_id`, `user_id`, `fname`, `employer_id`, `job_id`, `date_applied`, `status`) VALUES
(2, 3, '', 18, 5, '2022-09-11', 'Declined'),
(3, 4, '', 18, 6, '2022-09-11', 'Accepted'),
(4, 5, '', 18, 6, '2022-09-16', 'Accepted'),
(6, 2, '', 18, 2, '2022-09-29', 'Accepted'),
(7, 2, '', 18, 1, '2022-09-29', 'Accepted'),
(8, 3, '', 17, 8, '2022-10-06', 'Accepted'),
(9, 3, '', 18, 3, '2022-10-06', 'Accepted'),
(10, 3, '', 18, 2, '2022-10-06', 'Accepted'),
(11, 2, '', 18, 5, '2022-10-06', 'Pending'),
(12, 2, '', 18, 6, '2022-10-06', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `user_id`, `seller_id`, `quantity`) VALUES
(1, 1, 1, 2, 1),
(21, 0, 0, 0, 0),
(22, 4, 0, 0, 0),
(26, 1, 0, 11, 0),
(44, 1, 2, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `credentials_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exp_1` varchar(255) NOT NULL DEFAULT 'none',
  `exp_2` varchar(255) NOT NULL,
  `exp_3` varchar(255) NOT NULL,
  `exp_4` varchar(255) NOT NULL,
  `exp_5` varchar(255) NOT NULL,
  `educ_1` varchar(255) NOT NULL,
  `educ_2` varchar(255) NOT NULL,
  `educ_3` varchar(255) NOT NULL,
  `educ_4` varchar(255) NOT NULL,
  `educ_5` varchar(255) NOT NULL,
  `cert_1` varchar(255) DEFAULT NULL,
  `cert_2` varchar(255) DEFAULT NULL,
  `cert_3` varchar(255) DEFAULT NULL,
  `cert_4` varchar(255) DEFAULT NULL,
  `cert_5` varchar(255) DEFAULT NULL,
  `cert_6` varchar(255) DEFAULT NULL,
  `pdf_file` longtext DEFAULT NULL,
  `pdf_cover` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`credentials_id`, `user_id`, `exp_1`, `exp_2`, `exp_3`, `exp_4`, `exp_5`, `educ_1`, `educ_2`, `educ_3`, `educ_4`, `educ_5`, `cert_1`, `cert_2`, `cert_3`, `cert_4`, `cert_5`, `cert_6`, `pdf_file`, `pdf_cover`) VALUES
(32, 2, '1yr in Google Software Engineer - 2015', '1yr in Facebook Software Engineer - 2016', '1yr in IBM Software Engineer - 2017', '1yr in Tesla Software Engineer - 2018', '1yr in Oracle Software Engineer - 2019', 'Tabaco National High School - 2015', 'Tabaco National High School, Senior High - 2018', 'Divine Word College of Legazpi - 2023', 'University of Standford Master of Science in Computer Science - 2026', 'Oxford University DPhil in Computer Science - 2030', 'cert.png', 'cert3.png', 'cert1.png', 'cert4.png', 'cert2.png', 'cert5.png', 'aceMalto.pdf', 'coverletter.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_post`
--

CREATE TABLE `jobs_post` (
  `post_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_company` text NOT NULL,
  `job_about` text NOT NULL,
  `job_title` text NOT NULL,
  `job_experience` text NOT NULL,
  `job_qualification` text NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT '../img/job_ecom_default_logo.png',
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs_post`
--

INSERT INTO `jobs_post` (`post_id`, `employer_id`, `job_company`, `job_about`, `job_title`, `job_experience`, `job_qualification`, `logo`, `date_posted`) VALUES
(1, 18, 'Accenture', 'Join our high-performing team and enjoy these benefits: Competitive salary package, company bonuses, and performance incentives,Night differential, Loyalty, Christmas gift, inclusion, and diversity benefits, Paid sick and vacation leaves, Expanded maternity leave up to 120 days*, HMO coverage (medical and dental) from day 1 of employment, Life insurance, internet allowance, Flexible working arrangements, Healthy and encouraging work environment', 'Accenture Cebu | Recruitment Associate | WFH', 'Open to college graduates in Psychology, HRDM-related courses, Must have at least 6 months to 1 year of work experience in Recruitment / Sourcing / Human Resources, and Work From Home', 'Bachelor\'s/College Degree, Professional, License (Passed Board/Bar/Professional License Exam) You will communicate with candidates via call, SMS, and/or email, You will be scheduling candidates for skills screening and assessment, You will support recruitment activities (i.e., roadshow, learning session, events), You will be asks to perform ad hoc tasks (i.e., team engagement activities, ISMS, workstream participation)', '1643136297632ff253349c8.png', '2022-09-09'),
(2, 18, 'Accenture', 'For faster processing of your application, please make sure to have your latest NBI clearance ready. For successful candidates who worked with previous employers, please prepare your approved resignation letter, SSS employment history and Statement of Account. Your recruiters will also remind you of other requirements you can prepare ahead of time', 'General Accounting Associate | Record-to-Report WFH', 'What are we looking for? Bachelor’s degree in Accounting-related courses, Open to Fresh Graduates with CPA license, Open to Non-CPA with 6 months to 1 year of work experience in collecting, processing, and presenting accurate financial data (Record-To-Report),', 'Bachelor\'s/College Degree, Post Graduate Diploma/Master\'s Degree, Professional License (Passed Board/Bar/Professional License Exam), Less than 1 Year Experienced Employee', '1643136297632ff253349c8.png', '2022-09-09'),
(3, 18, 'Accenture', 'For faster processing of your application, please make sure to have your latest NBI clearance ready. For successful candidates who worked with previous employers, please prepare your approved resignation letter, SSS employment history and Statement of Account. Your recruiters will also remind you of other requirements you can prepare ahead of time.', 'Recruiting New Associates | Accenture Cubao | WFH', 'What are we looking? Open to college graduates in Psychology, HRDM or related, No experience required, Willing to work in Cubao, Quezon City or Work from Home, Good to have skills:Knowledge in recruitment and human resources roles, Familiarity with Excel functions in the purpose of reports and analytics', 'Join our high-performing team and enjoy these benefits: Competitive salary package, company bonuses, and performance incentives, Night differential, Loyalty, Christmas gift, inclusion, and diversity benefits, Paid sick and vacation leaves, Expanded maternity leave up to 120 days*, HMO coverage (medical and dental) from day 1 of employment, Life insurance, Career growth and promotion opportunities', '1643136297632ff253349c8.png', '2022-09-09'),
(4, 18, 'Accenture', 'For faster processing of your application, please make sure to have your latest NBI clearance ready. For successful candidates who worked with previous employers, please prepare your approved resignation letter, SSS employment history and Statement of Account. Your recruiters will also remind you of other requirements you can prepare ahead of time.', 'Customer Service Associate | WFH | On-site', 'What are we looking? Open to college graduates, college undergraduates, and associate degree graduates, Must have at least 1 year of work experience in a BPO industry, Willing to go back on-site once recalled. Good to have skills: Experience in handling sales (inbound or outbound), collections, insurance, or travel account in any industry', 'High School Diploma, Vocational Diploma/Short Course Certificate, Bachelor\'s/College Degree, 1-4 Years Experienced Employee', '1643136297632ff253349c8.png', '2022-09-09'),
(5, 18, 'Accenture', 'For faster processing of your application, please make sure to have your latest NBI clearance ready. For successful candidates who worked with previous employers, please prepare your approved resignation letter, SSS employment history and Statement of Account. Your recruiters will also remind you of other requirements you can prepare ahead of time.', 'Workforce Management New Associate | WFH', 'What are we looking for? Open to college graduates, No experience required, Willing to go back on-site once recalledExperience in using Real Time Management systems (e.g. Avaya, CUIC, Genesys, In Contact), Familiarity with DANER approach in monitoring real time activities', 'Bachelor\'s/College Degree, Professional License (Passed Board/Bar/Professional License Exam),Less than 1 Year Experienced Employee', '1643136297632ff253349c8.png', '2022-09-09'),
(6, 18, 'Accenture', 'Accenture in the Philippines is currently looking for Data Entry Analysts who will be responsible in performing the following day-to-day tasks: You will be performing date entry and research various systems and tracking tools. You will apply knowledge of processes and related systems to assist in identifying, assessing, and resolving issues/problems.You will be asks to execute transactions without minimal direction, enter data and retrieve information from group specific system (all new hires might require some direction initially. You will be asks to respond to information requests by searching, summarizing research results, and compiling in requested format.  For faster processing of your application, please make sure to have your latest NBI clearance ready. For successful candidates who worked with previous employers, please prepare your approved resignation letter, SSS employment history and Statement of Account. Your recruiters will also remind you of other requirements you can prepare ahead of time.', 'Accenture Alabang | Data Entry Analyst | Non Voice | WFH', 'Open to college graduates, college undergraduates, and associate degree graduates with at least 1 year of work experience in a BPO industry', 'Job Highlights: With 30,000* Signing Bonus!, HMO Coverage From Day 1 of Employment, Open to college graduates, college undergraduates, and associate degree graduates with at least 1 year of work experience in a BPO industry, Willing to go back on-site once recalledBachelor\'s/College Degree, Post Graduate Diploma/Master\'s Degree, Professional License (Passed Board/Bar/Professional License Exam) 1-4 Years Experienced Employee', '1643136297632ff253349c8.png', '2022-09-09'),
(7, 17, 'Concentrix', 'Dare to be #DifferentByDesign? Grab the opportunity to be part of a global organization where Experience is Everything. Enjoy a disruptive workplace as we provide endless learning opportunities, sustainable career development, and an employee centric environment. #OneBoldFuture Job Summary: The Technical Specialist - Consumer Support (Technical Support Advisor) Responds to Basic and Routine Inquiries of a Technical Nature, which includes Hardware/Software and Other designated Client Product(s). The incumbent is responsible in providing assistance to External User(s) of the Client\'s Technical Product(s) or Services by Answering Related Question(s) and Providing Resolution Option(s) Involved in their Use - while also Ensuring that Services Delivered to all the Consumers are Aligned with Contractual Performance Indicator(s).', 'Technical Specialist Network Services | WFH - URGENT', 'Technical Specialist', 'Bachelor\'s/College Degree Minimum Hiring Qualifications: • Associate\'s Degree in a Related Technical Discipline - with   1YEAR(S) MIN of Related-Experience - (BPO and Related   Environment Performing Similar Functions/Scope of Work) • Excellent Written/Verbal/Visual Communication-Skills, with   Strong Interpersonal Skills, Building Positive-Relationships • Relevant Technical Expertise Required: HARDWARE AND   SOFTWARE, NETWORKING, TROUBLESHOOTING, and   DATA STORAGE/REPAIR; Articulate Technical-Concept(s) • Working Knowledge of Client Technical System(s) Needed • Advantage: Industry-Standard Training(s) + Certification(s) • Skilled in Multi-Tasking - Including the Ability to be Flexible   & Adapt to Change(s) quickly; Proficient-Attention to Detail • Demonstrate patience in all Customer Contact Situation(s) • Amenable with Shifting Schedule(s) and Voice Interactions Get Hired and Enjoy the Following: • Competitive Compensation for all Successful Hires • Collaborative & Challenging-Working-Environment • Multiple Opportunities for Learning & Development', 'concentrix.png', '2022-09-09'),
(8, 17, 'Concentrix', 'Concentrix is a multi-awarded CX (Customer Experience) Solutions company that prides itself on being FANATICAL towards its clients and staff. We aim to provide exceptional service to customers and extend career success to employees. #JoinCNXC #DifferentTogether', 'Customer Support Specialist - Largest Search Engine! - With or Without Experience! Get up to 24K* a month + HMO', 'WHAT YOU NEED TO KNOW ABOUT THE DAY-TO-DAY TASKS OF A CUSTOMER SERVICE REPRESENTATIVE  ·        Answering incoming calls from customers  ·        Sorting out customers’ inquiries or requests  ·        Ensuring that customers’ requests are managed in an appropriate and timely manner  ·        Developing, organizing, and maintaining accurate files  ·        Maximizing different Concentrix and client-based tools and applications for customer management and servicing  ·        Delivering a high caliber of service in a friendly, confident, and informed manner YOU ARE A PERFECT FIT FOR THE POSITION IF YOU:  ·         Are a High School or Senior High School graduate, with or without BPO experience  ·         Have at least six (6) months BPO experience  ·         Have good English communication skills  ·         Have excellent customer service, problem-solving, and multitasking skills  ·         Have superb computer skills  ·         Are willing to work in shifting schedule  HAVE A GLIMPSE OF WHAT AWAITS YOU!  •    Paid training  •    Competitive salary plus allowances  •    Monthly performance incentives  •    Leave Credits  •    Insurance Coverage  •    HMO  •    Career development and advancement opportunities', 'High School Diploma, Vocational Diploma/Short Course Certificate, Bachelor\'s/College Degree Less than 1 Year Experienced Employee', 'concentrix.png', '2022-09-09'),
(9, 17, 'Concentrix', 'Dare to be #DifferentByDesign? Grab the opportunity to be part of a global organization where Experience is Everything. Enjoy a disruptive workplace as we provide endless learning opportunities, sustainable career development, and an employee centric environment. #OneBoldFuture Job Summary: The Network Specialist - Consumer Support (Technical Support Advisor) Responds to Basic and Routine Inquiries of a Technical Nature, which includes Hardware/Software and Other designated Client Product(s). The incumbent is responsible in providing assistance to External User(s) of the Client\'s Technical Product(s) or Services by Answering Related Question(s) and Providing Resolution Option(s) Involved in their Use - while also Ensuring that Services Delivered to all the Consumers are Aligned with Contractual Performance Indicator(s).', 'Network Specialist (Consumer Support) - Network Services Account - URGENT', 'Essential Duties and/or Responsibilities: • Assist External-User(s) of our Client\'s Technical-Product(s)   Or Service(s) - (Investigate, Research and Identify-Provide   Resolution to User Questions/Problems) • Greet Customers In a Courteous and Professional-Manner   Using Agreed Upon Procedure(s) - Listen Attentively to our   Customer\'s Needs & Concern/s and demonstrate Empathy   while Maximizing-Opportunity To Build Rapport w/ Client(s) • Clarify the Customer Requirement(s) and Probe To Ensure   Understanding - Ensure Complete & Accurate-Work, which   Includes Properly-Notating the Accounts • Participate In Activities designed To Improve our Customer   Satisfaction, and Overall Business Performance - Standing • Troubleshoot Basic and Routine Customer Issue/s that are   Technical in Nature: Hardware + Software, Networking and   Other designated Client-Product(s) - Solve Problem(s) that   are Generally-Unstructured (and Require Extensive-Use of   Conceptual-Thinking skill(s) for Closure) • Follow Appropriate Escalation path to Resolve Tech Issues   including Making follow-ups via Outbound Calling & Emails   to Customer(s) & Other Parties as Needed - (Ensuring that   Service Delivered Meets Contractual Performance Metrics) Minimum Hiring Qualifications: • Associate\'s Degree in a Related Technical Discipline - with   1YEAR(S) MIN of Related-Experience - (BPO and Related   Environment Performing Similar Functions/Scope of Work) • Excellent Written/Verbal/Visual Communication-Skills, with   Strong Interpersonal Skills, Building Positive-Relationships • Relevant Technical Expertise Required: HARDWARE AND   SOFTWARE, NETWORKING, TROUBLESHOOTING, and   DATA STORAGE/REPAIR; Articulate Technical-Concept(s) • Working Knowledge of Client Technical System(s) Needed • Advantage: Industry-Standard Training(s) + Certification(s) • Skilled in Multi-Tasking - Including the Ability to be Flexible   & Adapt to Change(s) quickly; Proficient-Attention to Detail • Demonstrate patience in all Customer Contact Situation(s) • Amenable with Shifting Schedule(s) and Voice Interactions Get Hired and Enjoy the Following: • Competitive Compensation for all Successful Hires • Collaborative & Challenging-Working-Environment • Multiple Opportunities for Learning & Development', 'Bachelor\'s/College Degree, 1-4 Years Experienced Employee', 'concentrix.png', '2022-09-09'),
(10, 17, 'Concentrix', 'Dare to be #DifferentByDesign? Grab the opportunity to be part of a global organization where Experience is Everything. Enjoy a disruptive workplace as we provide endless learning opportunities, sustainable career development, and an employee-centric environment. #OneBoldFuture', 'Workforce Real Time Analyst - (Remote/WAH)', 'Essential Functions/Core Responsibilities:  Make tactical recommendations for SME Contact Centres to meet Service Level targets at a whole Critically evaluate day-to-day function of the Real Time Analyst role, and recommend automation where possible Balance Service Levels between queues Manage short-term resource shrinkage, and prioritise shrinkage accordingly Manage frontline allocation to queues including skilling Conduct ad-hoc analysis when required to provide the rationale behind recommendations Assist other members of the operations team where necessary, Knowledge/Experience:  Knowledge and exposure to contact centre statistics and management Ability to interpret contact centre data and draw meaningful and insightful conclusions High level of written and verbal communication Strong numerical capability Strong technical skills in analytics & data tools, contact centre software packages (Verint & Genesys preferred) Advanced MS Office skills Time management and planning skills, ability to effectively prioritise projects and pieces of work Learn quickly and adapt to a dynamic environment Problem solving, ensuring that all key stakeholders are part of the solution Work effectively with management teams Communicate with a broad range of internal clients', 'Not Specified, 1-4 Years Experienced Employee', 'concentrix.png', '2022-09-09');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `incoming_message_id` int(11) NOT NULL,
  `outgoing_message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL,
  `chat_date_time` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `incoming_message_id`, `outgoing_message_id`, `message`, `image`, `files`, `chat_date_time`, `status`) VALUES
(1, 4, 2, 'hello', '', '', '2022-09-21 13:42:06', ''),
(3, 4, 2, 'sent a photo.', '1868981850.jpg', '', '2022-09-21 13:44:46', ''),
(4, 4, 2, 'sent a file.', '', 'Letter of Authorization.docx', '2022-09-21 13:45:04', ''),
(5, 4, 2, 'wqe', '', '', '2022-09-21 13:45:12', ''),
(6, 4, 2, 'we', '', '', '2022-09-21 13:45:12', ''),
(7, 4, 2, 'ew', '', '', '2022-09-21 13:45:12', ''),
(8, 4, 2, 'ew', '', '', '2022-09-21 13:45:13', ''),
(9, 4, 2, 'wew', '', '', '2022-09-21 13:46:41', ''),
(10, 4, 2, 'Heey', '', '', '2022-09-21 22:57:13', ''),
(11, 4, 2, 'sent a photo.', '1523666474.jpg', '', '2022-09-21 22:57:24', ''),
(12, 4, 2, 'Helllooo', '', '', '2022-09-21 22:57:42', ''),
(13, 4, 2, 'sdsa', '', '', '2022-09-29 22:59:25', ''),
(14, 4, 2, 'hello', '', '', '2022-09-29 22:59:35', ''),
(15, 4, 2, 'nice', '', '', '2022-09-29 22:59:44', ''),
(16, 4, 2, 'sent a photo.', '348846899.png', '', '2022-09-29 22:59:51', ''),
(17, 2, 18, 'hi! Ace', '', '', '2022-10-03 13:02:08', ''),
(18, 18, 2, 'csfssd', '', '', '2022-10-03 13:23:53', ''),
(19, 18, 2, 'hi there', '', '', '2022-10-03 13:29:42', ''),
(20, 2, 18, 'hello Ace', '', '', '2022-10-03 13:29:50', ''),
(21, 2, 18, 'sent a photo.', '840812208.png', '', '2022-10-03 13:31:07', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `complete_address` text NOT NULL,
  `zip_code` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'Preparing',
  `date_ordered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `fname`, `phone`, `complete_address`, `zip_code`, `product_id`, `quantity`, `trx_id`, `order_status`, `date_ordered`) VALUES
(3, 2, 'Ace Malto', 3213, '#15, Tabaco City Hall, Llorente St., Quinale-Cabasan, Tabaco City$complete_address', 3214, 8, 2, 'TRXMA-6320899E8C70B', 'Preparing', '2022-09-13'),
(9, 5, 'Dianne Binucas', 0, '', 0, 8, 1, 'TRXMA-632476CDBEC55', 'Preparing', '2022-09-16'),
(10, 5, 'Dianne Binucas', 0, '', 0, 18, 1, 'TRXMA-632484C17FFBE', 'received', '2022-09-16'),
(12, 2, 'Ace Malto', 2147483647, 'San Juan (Pob.)', 4511, 3, 1, 'TRXMA-6331B522AF49D', 'Order Received', '2022-09-26'),
(14, 5, 'Dianne Binucas', 2147483647, 'Agnas (San Miguel Island)', 4500, 14, 1, 'TRXMA-633E2D07A7E5A', 'Preparing', '2022-10-06'),
(15, 5, 'Dianne Binucas', 2147483647, 'Agnas (San Miguel Island)', 4500, 16, 3, 'TRXMA-633E2D07A7E5A', 'Preparing', '2022-10-06'),
(16, 5, 'Dianne Binucas', 2147483647, 'Agnas (San Miguel Island)', 4500, 5, 1, 'TRXMA-633E2D07A7E5A', 'Preparing', '2022-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `file1` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `file3` varchar(255) NOT NULL,
  `file4` varchar(255) NOT NULL,
  `file5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `brand`, `seller_id`, `product_name`, `quantity`, `price`, `product_description`, `product_category`, `shipping_fee`, `file1`, `file2`, `file3`, `file4`, `file5`) VALUES
(1, 'Babolat', 11, 'Babolat Blast unisex', 298, 2500, 'good Quality from factory', 'shoes unisex', 50, 'b4.jpg', 'b3.jpg', 'b5.jpg', 'b1.jpg', 'b2.jpg'),
(2, 'Asus ROG', 11, 'Asus - Rog Cetra True Wireless', 283, 4990, 'Brand Model: ASUS ROG Cetra TWS How to use: In-ear Headphone material: plastic Headphone Category: True Wireless Headphones Connection method: wireless Bluetooth version: 5.0 Waterproof performance: IPX4 Drive size: 10 mm Headphone Impedance: 32 ohm Headphone Frequency Response: 20Hz - 20KHz Microphone Directivity: Directivity Microphone Sensitivity: -38 dB Microphone Frequency Response: 100Hz - 10KHz Active Noise Cancellation: Support Channel: Stereo Battery: Approx. 4.8 + 17 hours (ANC On) Approx. 5.5 + 21.5 hours (ANC Off) Weight: Headphones (each side) 5g, charging case 42g', 'mobile & gadget', 50, '2.jpg', '1.png', '3.png', '4.jpg', '5.png'),
(3, 'Adidas', 11, 'Adidas Adidas Crazy Explosive 2017 PK Adidas Wiggins Adidas Wiggins Men\'s Basketball Shoes', 147, 850, 'good Quality from factory', 'men shoes', 50, 's1.png', 's2.png', 's3.png', 's4.png', 's5.png'),
(4, 'TLC', 11, 'Monitor', 4, 6000, '27hrz 27inch', 'computers & accessories', 50, 't1.png', 't2.png', 't3.png', 't4.png', 't5.png'),
(5, 'Cat Ear Headset', 11, 'Original Meet Earphone Cat Ear Headphone Bluetooth 5.0 LED Adjustable Foldable Headphones', 98, 138, 'This glowing cat ear Bluetooth headphones is specially designed for music lovers and fashion enthusiast, which  Features advanced Bluetooth 5.0 technology, 3.5mm audio port, hands-free function, and glowing cat ear. It is a perfect gift for children, girlfriends and cosplayers.  Features: BT V5.0+EDR Technology: Easy to pair with almost any Bluetooth-enabled audio player devices, and equipped with 3.5mm audio jack (provides a simple wired connection of a variety of music devices, such as MP3 / MP4, etc. for Bluetooth-disenabled devices). Hands-free Calls with Mic: With high-sensitivity microphone, you can enjoy clear hands-free calls anytime and anywhere. Ergonomic Design: It is light and portable with adjustable headband length design. Its ear cushion design is based on the outline of the human ear which is comfortable to wear and can greatly insulate the noise around you, so you can hear your music and call clearly. Long Standby Time: Built-in rechargeable Lithium battery lasts about 2 hours with LED light on and 450 hours of standby time per charge cycle. Multichoice: Multiple music modes for you to choose, such as Card mode, Bluetooth mode, wired mode. Glowing Cat Ear: There is a light button at the right part of the headphone for you to control the light; long-press it and the light will on; press it once and it will change colors; double press it and the seven colors will flash alternately; long-press it again and the light will off.  Specifications: Model Number: ZW-028 Bluetooth version: BT V5.0+EDR Operation Distance: 15m Frequency Response Range: 20Hz-20KHz Speaker Unit: 40mm Battery: 360mAh Rechargeable Polymer Lithium Battery Working Time: about 5 hours with LED light on Standby Time: 200 hours   Charge Time: approx. 2 hours Charge Port: Micro USB Plug Type: 3.5mm Audio Port Color: Gray Pink, Purple Pink, Black, Green, White Earmuff Diameter: approx. 7.3 cm / 2.87in Main item size: approx. 18 * 8 * 20 cm / 7.09 * 3.15 * 7.87in Item weight: approx. 185.3g / 6.54 oz Package size: approx. 20 * 8.5 * 22cm / 7.87 * 3.35 * 8.66in Package weight: approx. 328g / 11.57oz  Package List: 1 * Headset 1 * USB Cable 1 * Audio Cable   1 * User Manual (English & Chinese)', 'computers & accessories', 100, 'cat_ear_headset_1.png', 'cat_ear_headset_3.png', 'cat_ear_headset_4.png', 'cat_ear_headset_2.png', 'cat_ear_headset_5.png'),
(6, 'P47', 12, 'P47 Bluetooth Headphone Earphones', 199, 140, 'Product Description USB Charge: DC5VIN FM Frequency: 87.5-108MHz Frequency: 50HZ-20KHz Bluetooth: 2.401-2.480GHz Call Duration: 6 hours SNR: 88 Db Bluetooth Distance: 10m Output power: 35mW Charging time: 2 hours Standby time: 18 hours Driver unit: 40 mm  AVRCP remote control capabilities Supports automatic switchover to incoming call function with end number redial function compatible with ROHS standards  What\'s in the box : 1 X Headphone 1 X USB Cable #bluetooth headphone #bluetooth earphones #headsets #headphones #earphones #p47 wireless headphone#bluetooth headset', 'computers & accessories', 100, 'p47_1.png', 'p47_2.png', 'p47_3.png', 'p47_4.png', 'p47_5.png'),
(7, 'casual shoes', 12, 'Men\'s casual shoes lightweight breathable woven running shoes wholesale', 49, 192, 'Brand: other / other Function: breathable Closure: frenulum Size: 39 40 41 42 43 44 Pattern: others Style: Leisure Heel height: flat heel (less than or equal to 1cm) Color classification: Black Season: Summer Toe style: round head Occasion: Daily Sole material: plastic upper Lining material: mesh Suitable for: young people (18-40 years old) Shoe making process: injection pressure shoes Upper material: mesh Style: outdoor casual shoes Manufacturers direct sales price advantage is obvious, manufacturers direct to customers, no middleman', 'men shoes', 100, 'woven_breathable_1.png', 'woven_breathable_2.png', 'woven_breathable_3.png', 'no-image.jpg', 'no-image.jpg'),
(8, 'Fantech', 12, 'Fantech X9 MACRO RGB GAMING MOUSE - Black', 95, 498, '-Omron 10,000,000 cLICK lIFE TIME -1.8m Nylon Braided Cable -Tracking Method: Optical -smooth mouse feet -125hz Polling rate High Speed -non- slip side -Style: 6D -15g -Hand Orientation: Both Hands -Brand Name: Fantech -Cable length: 1.8m braided -Cable Color: black Supported OS:Windows Vista, Win7/8/10, Mac OS X 10.5 or later, Linux, Chrome OS', 'computers & accessories', 100, 'fantech_mouse_1.png', 'fantech_mouse_2.png', 'fantech_mouse_3.png', 'fantech_mouse_4.png', 'fantech_mouse_5.png'),
(9, 'Fantech', 12, 'Fantech K613 K613L Fighter TKL-II Tournament Edition Gaming Keyboard - Black', 49, 699, 'PRODUCT NAME : Backlit Floating-keys Multimedia Gaming Keyboard NUMBER OF KEYS : 87 keys WORKING VOLTAGE: DC 4.2-5.5V SWITCH : Floating Switch 45g Trigger Pressure POLLING RATE : 1000Hz Ultrapolling Rate KEYSTROKE : 8 Million Keystroke Lifetime GHOSTING : 19 Keys Anti-ghosting CABLE : Nylon Copper Cable Operating systems: Windows XP/7/8/10; MAC OS One free USB 2.0/3.0 port FANTECH K613 is a plug and play usb interface RGB keyboard, no need to install any driver for your first use.', 'computers & accessories', 100, 'fantech_keyboard_1.png', 'fantech_keyboard_2.png', 'fantech_keyboard_3.png', 'fantech_keyboard_4.png', 'fantech_keyboard_5.png'),
(10, 'Fantech', 12, 'Fantech BEAT GS203 Mobile Gaming and Music Wired Speakers with Bass Resonance Membrane Speaker', 49, 388, 'Fantech BEAT GS203 Mobile Gaming and Music Wired Speakers with Bass Resonance Membrane Speaker  Product Information:  Clear, Deep, and Perfect Sound 360° surround sound Hi-res audio 45mm driver unit Lighting effects Magnet free material body Multi-platform compatibility (Laptop, Desktop, Cellphone) USB& 3.5mm plug Dimensions: 100mm*80mm', 'computers & accessories', 100, 'fantech_speaker_1.png', 'fantech_speaker_2.png', 'fantech_speaker_3.png', 'fantech_speaker_4.png', 'fantech_speaker_5.png'),
(11, 'Knitted Clothes', 13, 'Plain Knitted blouse short sleeve', 30, 155, '🌼knitted blouse short sleeve 💪Non-fade ❤️plain 👉free size fit to semi XL  ✔✔✔ length:22  🚚DELIVERY PERIOD: The system will automatically allocate logistics when you place the order. *3-5 days metromanila *7-10 days provincial   PLEASE READ CAREFULLY BEFORE PLACING ORDER  📲HOW TO ORDER? *Click buy now *Choose variation then quantity *Complete shipping address *Procced check out and select mode of payment *COD We strongly recommend J&T Express to you, because they will upload the rider\'s mobile phone number when delivering the package!   #goodquality#knittedtop#knitted#knit#knittedtshirt#lbc#cod#lbccod#ownpackage#wholesale#factoryprice#bestseller#cashondeliver#nonfading#nonfade#ladies#womens#fashio', 'women clothes', 100, 'women_knitted_clothes_1.png', 'women_knitted_clothes_2.png', 'women_knitted_clothes_3.png', 'women_knitted_clothes_4.png', 'women_knitted_clothes_5.png'),
(12, 'Serenity', 13, 'Serenity girl Korean version Explosive models Women Tshirt #SARENITY', 50, 200, 'Welcome to our store! Material: Polyester Size: M, L, XL note: (1) The color of the item may be slightly different from the picture due to differences in light and screen. (2) Each product size is measured manually, if there is a 1-3cm error within a reasonable range. (3) If you are satisfied with our products, please give us a positive feedback (5 stars). You can share it with your friends on Facebook, Twitter... Thank you! (4) Please contact us before leaving any negative feedback or initiating a dispute on Shopee. (5) Please give us the opportunity to solve any problems. We will update new products for a long time, your support is our unlimited power!', 'women clothes', 100, 'serenity_1.png', 'serenity_2.png', 'serenity_3.png', 'no-image.jpg', 'no-image.jpg'),
(13, 'blouse', 13, 'Blouse for women short sleeve blouse tops for women tshirt for women blouse korean printed tshirt', 50, 135, 'Product description\'\' *Clothing Materials: Cotton         *Color safe *Comfortable to wear  \"Service\" *COD *Order today ship tomorrow *All items are 100% new and we offer a good quality of the product for its best price!!    Note: Kindly select the correct variation of the item before placing your orders to avoid orders mistake..All items are on hand and we will ship your order as early as we can....For late deliveries, please don\'t blame us courier is out of our control.... Any questions regarding our product/ items, kindly message us...  _Please don\'t forget to rate us or give us 5star if you are satisfied with our product/items and service.              ----Thank you and Happy shopping!!...', 'women clothes', 100, 'blouse_1.png', 'blouse_2.png', 'blouse_3.png', 'blouse_4.png', 'blouse_5.png'),
(14, 'Serenity', 13, 'Fashionable round neck t-shirt,short sleeve women t-shirt#SARENITY', 119, 200, 'Material: Polyester Size: M, L, XL note: 1. About size: The size is determined according to the official size chart of the wish. You can choose a size 1-2 larger because the Asian size is still small. Please make sure the size fits you. 2. Regarding the color: Due to the different colors displayed on different mobile phones and computers, the color of the actual item may be slightly different from the above picture. 3. About the error: as a physical measurement value, the error of 1-2 cm belongs to the normal range. thank you for understanding. 4. About the problem: If you have any questions, please contact us in time. We will try our best to solve it. 5. About rating: If you are satisfied with our product, please give a five-star rating to let more people know.    Thank you.', 'women clothes', 100, 'round_neck_1.png', 'round_neck_2.png', 'round_neck_3.png', 'no-image.jpg', 'no-image.jpg'),
(15, 'vans', 13, 'Ladies RoundNeck Tshirt Simple Printed Shirt Short Sleeves Fit to (S,M,L,Xl) tops shirt for women', 60, 320, 'LADIES TSHIRT (kindly Check the Size Chart)   ✅Please refer to the size table for measurement.  Do not assume that these are measured by the appropriate age group.   ✅100% cotton perfect T-shirt.   ✅Round neck, Short sleeves, Comfortable to wear   ✅Lowest price   ✅Can be paid in cash #COD   ✅Fast Shipping   ✅No minimum order required   ✅Casual and Fashion Style   ✅We will ship locally within 2 days   ✅Premium Cotton   ✅Sizes S, M, L, XL   ✅Announcement   Please be careful and careful when trying to wash TShirts for the first time.  Rinse TShirt carefully in water for a short period of time to remove excess colors (the pictures taken and the actual object will have some color differences, if you mind, please do not place the order). If the order is not out of stock, it is not allowed to cancel the order. Please read the product description carefully before placing the order.    Delivery time:   Metro Manila: 3-5 normal days   Provincial level: 4-9 normal days    Welcome to the official factory outlet store:   Factory outlet stores provide high-quality products.  We provide the most fashionable designs at reasonable prices. Please kindly leave us a positive feedback (5 STARS) , if you are satisfied with our items. Please contact us before leaving any negative feedback or open a dispute on SHOPEE    #DirectFactory #Hashtag', 'women clothes', 100, 'vans_women_cloth_1.png', 'vans_women_cloth_2.png', 'vans_women_cloth_3.png', 'vans_women_cloth_4.png', 'vans_women_cloth_5.png'),
(16, 'Nike', 14, 'Share:   Favorite (2.4K) Nike tshirt Cotton Tshirt Unisex Short Sleeved | Tshirt for Men and Women Gym Sports Tshirt', 47, 329, '✅Please refer to the size table for accurate measurement.  Do not assume that these are measured by the appropriate age group.   ✅100% perfect T-shirt.   ✅Crew neck/round neck, short sleeves, comfortable to wear   ✅The lowest price!   And can be paid in cash   ✅Ship the next day   ✅No minimum order required    ✅Announcement✅   Please be careful and careful when trying to wash TShirts for the first time.  Rinse TShirt carefully in water for a short period of time to remove excess colors (the pictures taken and the actual object will have some color differences, if you mind, please do not place the order). If the order is not out of stock, it is not allowed to cancel the order. Please read the product description carefully before placing the order    Mode of transportation:    J&T and Standard Delivery (Suitable for small batch orders. Can only accommodate 3 pairs of shoes / 2 large bags, weighing no more than 5 kg)    J&T and Standard Delivery packaging (no order limit, maximum weight 50kg)    Delivery time:   Metro Manila: 3-5 working days   Provincial level: 4-9 working days    Welcome to the official factory outlet store,   Factory outlet stores provide high-quality products.  We provide the most fashionable designs at reasonable prices.    #FactoryDirect #MFSunnies', 'men clothes', 100, 'nike_men_cloth_1.png', 'nike_men_cloth_2.png', 'nike_men_cloth_3.png', 'nike_men_cloth_4.png', 'nike_men_cloth_5.png'),
(17, 'NP', 14, 'NP Men\'s Short-sleeved T-Shirt Simple Round Neck Trend Tshirt', 50, 175, 'Color:White.Yellow Size:One Size Should:41cm Chest:46cm Length:63cm Sleeve:20cm  #menfashion #stretchable #cotton #goodquality #onesize', 'men clothes', 100, 'np1.png', 'np2.png', 'np4.png', 'np5.png', 'np3.png'),
(18, 'Short Sleev', 14, 'Men\'s short-sleeved T shirt with round neck cotton shirt', 19, 199, '✔Maliit po size ✔Maliit po size ✔Maliit po size  M- Shoulder 42cm   Length 60cm L-Shoulder 44cm   Length 62cm XL-shoulder 46cm   Length 64cm 2XL-shoulder  48cm   Length 66cm  Support cash on delivery  M  fit for weight 45-50KG   L fit for weight 50-60KG   XL fit for weight 60-65KG   XXL fit for weight 65-70KG    Remark size CHOOSE THE CORRECT VARATION IF THE ITEMS HAS DIFFERENT COLORS/PRINTS SO WE CAN AVOID MISTAKES ?WE ACCEPT RETURNS IF THE ITEM IS NOT YET WORN OR USED. BUYER WILL SHOULDER THE RETURN SHIPPING COST  LIKE & FOLLOW US FOR UPDATES!  1.Service (1)All of our items are as stated in their descriptions. (2)the items are 100% new,we offer the best product at the best price. (3)If the item you received is defective, please contact us immediately.  Allows use of Shopee promo codes for your security & more savings!  Feedback (1)Please kindly leave us a positive feedback (5 stars) , if you are satisfied with our items. And you could share with your friends on  Facebook, Twitter...Thanks (2)Please contact us before leaving any negative feedback or open a dispute on Shopee. (3)Please give us the opportunity to resolve any problem \"', 'men clothes', 100, 'sl1.png', 'sl2.png', 'sl3.png', 'sl4.png', 'no-image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `profile_pict` varchar(255) NOT NULL,
  `star_like` int(11) NOT NULL,
  `star_dislike` int(11) NOT NULL,
  `user_review` text NOT NULL,
  `review_picture_1` varchar(255) NOT NULL,
  `review_picture_2` varchar(255) NOT NULL,
  `review_picture_3` varchar(255) NOT NULL,
  `review_picture_4` varchar(255) NOT NULL,
  `date_review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `user_id`, `fname`, `profile_pict`, `star_like`, `star_dislike`, `user_review`, `review_picture_1`, `review_picture_2`, `review_picture_3`, `review_picture_4`, `date_review`) VALUES
(1, 2, 6, 'dianne', '', 5, 0, 'Good Products', '3.png', '1.png', '4.jpg', '5.png', 2022),
(11, 2, 2, 'Ace Malto', '../img/default_avatar.png', 4, 1, '', '', '', 'hello-kitty-face-transparent-png-858272.png', '', 2022),
(12, 3, 2, 'Ace Malto', '<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xampphtdocsjobsecomuserecommerce-details.php</b> on line <b>755</b><br />\r\n', 5, 0, 'Maganda naman yun Quality ng Sapatos Comfy naman gamitin lalo kung araw araw', '', '', '', '', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `email` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mode` varchar(11) NOT NULL,
  `type` int(5) NOT NULL,
  `otp` int(6) NOT NULL,
  `business` varchar(20) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company` varchar(20) NOT NULL,
  `about` varchar(255) NOT NULL,
  `pictures` varchar(255) NOT NULL DEFAULT 'default_avatar.png',
  `restriction` varchar(255) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `total_violation` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `status`, `title`, `fname`, `contact`, `email`, `gender`, `address`, `password`, `mode`, `type`, `otp`, `business`, `job_title`, `company`, `about`, `pictures`, `restriction`, `starting_date`, `ending_date`, `total_violation`) VALUES
(1, 'Offline now', '', 'Administrator', '', 'admin@admin.com', 'Male', 'San Juan (Pob.)', 'admin', '', 0, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(2, 'Offline now', 'Software Engineer', 'Ace Malto', '09876587654', 'acemalto28@gmail.com', 'Male', 'San Juan (Pob.)', 'acemalto', 'work', 1, 175503, '', '', '', 'BSCS - 4 Software Engineer', 'mark.png', '', '0000-00-00', '0000-00-00', 0),
(3, 'Offline now', '', 'Mark Limpo', '09876587657', 'limpomark26@gmail', 'Male', 'San Juan (Pob.)', 'marklimpo', 'work', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(4, 'Offline now', '', 'Aldon Rodriguez', '09869987654', 'aldon@gmail.com', 'Male', 'San Juan (Pob.)', 'aldon', 'user', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(5, 'Offline now', 'Quality Assurance', 'Dianne Binucas', '09876548765', 'dianne@gmail.com', 'Female', 'Agnas (San Miguel Island)', 'dianne', 'work', 1, 0, '', '', '', 'BSIT - 4', 'diannne.png', '', '0000-00-00', '0000-00-00', 0),
(6, 'Active now', '', 'Ivy Toledo', '09876897654', 'ivytoledo@gmail.com', 'Female', 'Agnas (San Miguel Island)', 'ivytoledo', 'user', 1, 0, '', '', '', '', 'default_avatar.png', 'Banned', '0000-00-00', '0000-00-00', 0),
(7, 'Offline now', '', 'James Bond', '09876876547', 'james@gmail.com', 'Male', 'Bangkilingan', 'jamesbond', 'user', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(8, 'Offline now', '', 'Macey Devera', '09876543765', 'macey@gmail.com', 'Female', 'Bantayan', 'maceydevera', 'work', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(9, 'Offline now', '', 'Shuhaily Casan', '09876548765', 'shuhaily@gmail.com', 'Male', 'Bogñabong', 'shuhaily', 'work', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(10, 'Active now', '', 'Nicky Palero', '09876598765', 'nickypalero@gmail.com', 'Male', 'Baranghawon', 'nickypalero', 'work', 1, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(11, 'Offline now', '', 'De Vera', '09398765435', 'devera@gmail.com', 'Male', 'San Juan (Pob.)', 'devera', '', 2, 0, 'Acee D Store', '', '', 'None', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(12, 'Active now', '', 'Lim uy', '09098765487', 'lim@gmail.com', 'Male', 'Basagan', '123456', '', 2, 0, 'Lim Parts', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(13, 'Offline now', '', 'Gemmy Borneo', '09876547654', 'gemmys@gmail.com', 'Female', 'Tabiguian', '123456', '', 2, 0, 'Gemmy Candles', '', '', '', 'ivy.png', '', '0000-00-00', '0000-00-00', 0),
(14, 'Offline now', '', 'Jackson Torre', '09876547865', 'jackson@gmail.com', 'Male', 'Mariroc', '123456', '', 2, 0, 'Jack Tabak', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(15, 'Offline now', '', 'Mike Miller', '09876587654', 'miller@gmail.com', 'Male', 'Bangkilingan', '123456', '', 3, 0, '', '', 'Recruiter BPO', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(16, 'Offline now', '', 'Arriane Asis', '09876578654', 'arriane22@gmail.com', 'Female', 'Salvacion', '123456', '', 3, 0, '', '', 'HR - Amando Cope', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(17, 'Offline now', '', 'Veldad', '09098765465', 'veldad@gmail.com', 'Male', 'Albay', '123456', 'Hr - Concen', 3, 0, '', '', 'Hr - Concentrixs', '', 'aldon.png', '', '0000-00-00', '0000-00-00', 2),
(18, 'Active now', '', 'selvin', '09876548765', 'melvin@gmail.com', 'Male', 'Cormidal', 'Acemalto1234567!', 'Hr-Accentur', 3, 0, '', '', 'Hr-Accenture', '', 'nicky.png', '', '0000-00-00', '0000-00-00', 0),
(19, 'Active now', '', 'admin1', '', 'admin1@admin.com', '', '', 'admin1', '', 0, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(20, '', '', 'admin2', '', 'admin2@admin.com', '', '', 'admin2', '', 0, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0),
(21, '', '', 'admin3', '', 'admin3@admin.com', '', '', 'admin3', '', 0, 0, '', '', '', '', 'default_avatar.png', '', '0000-00-00', '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`credentials_id`);

--
-- Indexes for table `jobs_post`
--
ALTER TABLE `jobs_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `credentials_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `jobs_post`
--
ALTER TABLE `jobs_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
