-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: webdb.uvm.edu
-- Generation Time: Feb 13, 2022 at 08:45 PM
-- Server version: 5.7.36-39-log
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CWFROST_Final`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblActivity`
--

CREATE TABLE `tblActivity` (
  `pmkActivityID` int(11) NOT NULL,
  `fldName` varchar(256) NOT NULL,
  `fldDescription` text,
  `fldWebsite` varchar(256) DEFAULT NULL,
  `fldImage` varchar(75) DEFAULT NULL,
  `fldStreetAddress` text NOT NULL,
  `pfkZipCode` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fldMapLink` varchar(2048) DEFAULT NULL,
  `pfkCreatedBy` int(11) NOT NULL,
  `fldCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fldLastModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fldApproved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblActivity`
--

INSERT INTO `tblActivity` (`pmkActivityID`, `fldName`, `fldDescription`, `fldWebsite`, `fldImage`, `fldStreetAddress`, `pfkZipCode`, `fldMapLink`, `pfkCreatedBy`, `fldCreated`, `fldLastModified`, `fldApproved`) VALUES
(36, 'Shelburne Orchards', 'If you’re lucky enough to be in the area, please don’t miss out on a visit to Shelburne Orchards! They have a unique setting with a view from the orchard out over Lake Champlain. They encourage you to bring a picnic, bring the family, sit back, take a deep breath, and relax. Oh, and pick some apples too!', 'https://www.shelburneorchards.com', 'image/activities/shelburneOrchards.png', '216 Orchard Rd', 05482, '', 14, '2020-11-29 14:00:01', '2020-12-04 05:28:23', 1),
(37, 'Hike Mt. Philo', 'The summit access road allows visitors to drive to the top, or a ¾-mile hiking trail leads to the mountain’s summit for more ambitious visitors. Hikers are likely to see a variety of wildlife including white-tailed deer or moose. The park is an excellent spot to watch autumn bird migrations, and is noted for raptor watching. A small campground is located on the north side of the park. Due to the steep grade and narrow width of the roadway, recreational vehicles are not suited to this park.', 'https://vtstateparks.com/philo.html', 'image/activities/mtPhilo.jpg', '5425 Humphreys\' Rd.', 05445, 'https://www.google.com/maps/place/Mt.+Philo+State+Park/@44.2780592,-73.2147449,15z/data=!4m5!3m4!1s0x0:0x63d7885fc96aba09!8m2!3d44.2780592!4d-73.2147449', 14, '2020-11-30 14:33:07', '2020-11-30 18:56:56', 1),
(47, 'North Beach Park', 'North Beach is Burlington\'s largest beach and the only beach with active lifeguards in the summer season. With food concessions, a playground, restrooms with showers, picnic tables and grills, North Beach has something for everyone. During the summer months you can also rent kayaks, canoes and stand up paddleboards at the vendors kiosk and take full advantage of what Burlington has to offer. The park and beach are open all year.', '', 'image/activities/northBeach.jpg', '60 Institute Rd', 05408, '', 14, '2020-12-03 22:05:49', '2020-12-03 23:17:40', 1),
(48, 'Spirit of Ethan Allen', 'Lake Champlain’s Largest Cruise Ship and Floating Restaurant – A Burlington “Must Do!” Enjoy panoramic views of Lake Champlain and the Vermont Mountains while enjoying delicious food and beverage. The triple deck luxury cruise ship offers daily scenic, lunch, brunch and nightly themed dinner cruises available seven days a week. The Scenic Narrated Cruise will fascinate travelers with our Captain’s tales of history, geology and wildlife.', '', 'image/activities/spiritofEthanAllen.jpg', '1 College St', 05401, '', 14, '2020-12-03 22:20:15', '2020-12-03 23:18:02', 1),
(49, 'Bingham Falls', 'There are plenty of places to go hiking near Stowe, VT and Bingham Falls is a great place to start. This easy, half-mile out-and-back trail has convenient access right off of 108/Mountain Road near the popular Smugglers Notch State Park (SP). Due to the popularity of the area and easy access to the trail, you may come across many other fall enthusiasts on hot summer days. Don’t let that deter you, though, to see one of the most-loved falls in the state! Enjoy a dip in the cold water at the bottom of the 40-foot falls and the deep gorge views along the way.\r\n\r\nBingham Falls is open to the public for a variety of non-motorized recreational activities and can be accessed via Route 108/Mountain Road (parking is available in two paved pull offs on either side of the road) or through the Stowe Land Trust owned Mill Trail Property.', '', 'image/activities/csm_BinghamFalls_TomRogers_14_9518a5f0c6.jpg', 'Rt 108', 05672, '', 14, '2020-12-03 23:39:41', '2020-12-04 16:45:57', 1),
(50, 'Thundering Falls', 'If you’re looking for a short falls hike in central VT, you can’t beat the 0.4-mile one to Thundering Falls. Located near Killington, this quick walk takes you to the 6th tallest falls in the state, cascading an impressive 140 feet down a narrow gorge. This trail sees a lot of people, but the easy hike and falls make it worth the possible crowds. Other than this main attraction, there is also a historic mill powered by the rushing waters of Thundering Falls.', '', 'image/activities/thunderingFalls.jpg', '2295 River Rd', 05751, '', 14, '2020-12-03 23:44:02', '2020-12-03 23:44:38', 1),
(55, 'Groton State Forest', 'Groton State Forest is open for varied and dispersed recreation, including but not limited to camping, hiking, swimming, boating, fishing, hunting, trapping, horseback riding, cross country skiing, and snowshoeing. The Montpelier and Wells River Railroad bed was converted to a multi-use trail and is part of the Cross Vermont Trail. Snowmobiling is allowed on designated VAST trails.', '', 'image/activities/groton.jpg', 'N/A', 05667, '', 14, '2020-12-04 08:48:51', '2020-12-04 08:49:33', 1),
(58, 'Bennington Battle Monument', 'Monument to a key battle of the American Revolution. The monument stands over 300 feet tall. You can also go inside and up to get a view from inside the monument.\r\n\r\nOpen from 10AM - 5PM.', '', 'image/activities/battleMonument.jpg', '15 Monument Circle', 05201, '', 14, '2020-12-04 16:08:49', '2020-12-04 16:23:12', 1),
(59, 'Bennington Museum', 'Bennington Museum - a Museum of Art, History, and Innovation. Home to the largest public collection of Grandma Moses paintings and 19th-century Bennington Pottery, it also presents Battle of Bennington memorabilia and weaponry, and Gilded Age Vermont, highlighting the industrial and cultural innovation of the late 1800s to the 1920s including the 1924 Wasp Touring Car, paintings by William Morris Hunt, and works by Lewis Comfort Tiffany. Bennington Modernism Gallery celebrates the art created from the early 1950s through the mid-1970s by a group of avant-garde artists working in and around Bennington who led the nation in artistic thought and innovation.', '', 'image/activities/bennington-museum.jpg', '75 Main St', 05201, '', 14, '2020-12-04 16:18:00', '2020-12-04 16:23:42', 1),
(60, 'The Bennington Center for the Arts', 'The Bennington Center for the Arts continually exhibits the work of many of the finest representational artists from around the country. In addition to the artwork in the Center\'s temporary exhibitions, all of which is for sale, The Bennington also has a very impressive permanent collection of Native American art (Navajo rugs, pots, katsinas, paintings of and by Native Americans) as well as bird carvings by Master Carver Floyd Scholz. The Bennington is also home to the Covered Bridge Museum.', '', 'image/activities/the-bennington-center.jpg', '44 Gypsy Ln', 05201, '', 14, '2020-12-04 16:19:59', '2020-12-04 16:25:02', 1),
(61, 'Park–McCullough Historic House', 'The Park-McCullough House is the crown jewel of North Bennington, Vermont. Representing 150 years of Vermont history Park-McCullough also serves as a contemporary prism through which citizens of North Bennington and surrounding towns gather to share myriad perspectives and pleasures. The grounds are open daily, and tours are available on weekends. Additionally public programming, theatre and a music series are provided seasonally. Arguably the finest intact Victorian mansion in New England, the house was built in 1864-65 by attorney and entrepreneur Trenor W. Park (1823-1882) who amassed his fortune overseeing the California mining interests of John C. Fremont. Four generations of the family have lived on the property, including two governors, Hiland Hall and John G. McCullough. The thirty-five room mansion stands an important example of American Second Empire Style set on 200 acres in Southern Vermont. The mansion is the perfect venue for unique and memorable weddings and celebrations. Guests may tour the mansion, stroll the grounds, play games on the expansive lawns or relax on the wrap-around veranda during cocktail hour. The Carriage Barn is the perfect venue for live music, receptions and dance.', '', 'image/activities/park-mccullough-house.jpg', '1 Park St', 05257, '', 14, '2020-12-04 16:22:55', '2020-12-04 16:24:43', 1),
(62, 'Mount Mansfield State Forest', 'Mount Mansfield State Forest covers 44,444 acres in seven towns in Chittenden, Lamoille and Washington counties in Vermont. The towns are Bolton and Underhill in Chittenden County, Cambridge, Johnson, Morristown and Stowe in Lamoille County, and Waterbury in Washington County.', '', 'image/activities/MtMansfieldStateForest_201008_(14130254932).jpg', '175 Pleasant Valley Rd', 05489, '', 24, '2020-12-04 16:41:11', '2020-12-04 16:45:57', 1),
(63, 'Sunset Rock', 'Small wooded park on a hill, formerly a 19th-century sheep pasture, with town &amp; mountain views. Enjoy a casual walk and nice views on a beautiful day.', '', 'image/activities/sunsetRock.jpg', 'Sunset Ave', 05672, '', 24, '2020-12-04 16:44:39', '2020-12-04 17:48:34', 1),
(64, 'Mills Riverside Park', 'A stunning view of Mt. Mansfield forms the background of Mills Riverside Park. This scenic vista is preceded by broad open meadow and is sharply defined by forested South Hill. Mills Riverside Park encompasses 216 acres of open meadow and wooded hillside with a stunning view of Mt. Mansfield. Over six miles of trail provide non-motorized, recreational opportunities year round. A beautiful post and beam pavilion offers park visitors an area for relaxing away from inclement weather. The pavilion can be reserved for special occasions.', '', 'image/activities/millsriversidepark.jpg', '338 VT-15', 05465, '', 19, '2020-12-04 16:52:15', '2020-12-04 16:58:36', 1),
(65, 'Grand Isle State Park', 'Grand Isle State Park is a 226-acre state park in Grand Isle, Vermont on the shore of Lake Champlain. Activities includes boating, swimming, camping, fishing, hiking, picnicking, bicycling, wildlife watching, water sports and winter sports. Facilities include a boat launching ramp, sand-court volleyball, horseshoes, a play area, 117 tent/RV sites, 36 lean-to sites, 4 cabin sites, restrooms with running water and hot showers, and a trailer sanitary station. The park features a nature center and park rangers offer interpretive programs including night hikes, campfire programs, amphibian explorations, and nature crafts and games.', '', 'image/activities/grandislepark.jpg', '36 E Shore S', 05458, '', 14, '2020-12-04 17:19:04', '2020-12-04 17:41:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblAttributes`
--

CREATE TABLE `tblAttributes` (
  `pfkActivityID` int(11) NOT NULL,
  `fldAttribute` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblAttributes`
--

INSERT INTO `tblAttributes` (`pfkActivityID`, `fldAttribute`) VALUES
(36, 'Outdoors'),
(36, 'No limit'),
(36, 'No!'),
(37, 'Outdoors'),
(37, 'Less than $30'),
(37, 'Yes!'),
(47, 'Outdoors'),
(47, 'Less than $30'),
(47, 'No!'),
(48, 'Outdoors'),
(48, 'No limit'),
(48, 'No!'),
(49, 'Outdoors'),
(49, 'Less than $30'),
(49, 'Yes!'),
(50, 'Outdoors'),
(50, 'Less than $30'),
(50, 'Yes!'),
(55, 'Outdoors'),
(55, 'Less than $30'),
(55, 'Yes!'),
(58, 'Indoors'),
(58, 'Less than $30'),
(58, 'No!'),
(59, 'Indoors'),
(59, 'Less than $30'),
(59, 'No!'),
(60, 'Indoors'),
(60, 'Less than $30'),
(60, 'No!'),
(61, 'Indoors'),
(61, 'Less than $30'),
(61, 'No!'),
(62, 'Outdoors'),
(62, 'Less than $30'),
(62, 'Yes!'),
(63, 'Outdoors'),
(63, 'Less than $30'),
(63, 'Yes!'),
(64, 'Outdoors'),
(64, 'Less than $30'),
(64, 'Yes!'),
(65, 'Outdoors'),
(65, 'Less than $30'),
(65, 'Yes!');

-- --------------------------------------------------------

--
-- Table structure for table `tblFavorites`
--

CREATE TABLE `tblFavorites` (
  `pfkUserID` int(11) NOT NULL,
  `pfkActivityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblFavorites`
--

INSERT INTO `tblFavorites` (`pfkUserID`, `pfkActivityID`) VALUES
(14, 48),
(24, 36),
(24, 37),
(14, 47),
(25, 37),
(14, 36);

-- --------------------------------------------------------

--
-- Table structure for table `tblLocation`
--

CREATE TABLE `tblLocation` (
  `pmkZipCode` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fldTown` varchar(64) DEFAULT NULL,
  `fldCounty` varchar(64) DEFAULT NULL,
  `fldState` char(2) DEFAULT 'VT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblLocation`
--

INSERT INTO `tblLocation` (`pmkZipCode`, `fldTown`, `fldCounty`, `fldState`) VALUES
(05001, 'White River Junction', 'Windsor', 'VT'),
(05009, 'White River Junction', 'Windsor', 'VT'),
(05030, 'Ascutney', 'Windsor', 'VT'),
(05031, 'Barnard', 'Windsor', 'VT'),
(05032, 'Bethel', 'Windsor', 'VT'),
(05033, 'Bradford', 'Orange', 'VT'),
(05034, 'Bridgewater', 'Windsor', 'VT'),
(05035, 'Bridgewater Corners', 'Windsor', 'VT'),
(05036, 'Brookfield', 'Orange', 'VT'),
(05037, 'Brownsville', 'Windsor', 'VT'),
(05038, 'Chelsea', 'Orange', 'VT'),
(05039, 'Corinth', 'Orange', 'VT'),
(05040, 'East Corinth', 'Orange', 'VT'),
(05041, 'East Randolph', 'Orange', 'VT'),
(05042, 'East Ryegate', 'Caledonia', 'VT'),
(05043, 'East Thetford', 'Orange', 'VT'),
(05045, 'Fairlee', 'Orange', 'VT'),
(05046, 'Goton', 'Caledonia', 'VT'),
(05047, 'Hartford', 'Windsor', 'VT'),
(05048, 'Hartland', 'Windsor', 'VT'),
(05049, 'Hartland Four Corners', 'Windsor', 'VT'),
(05050, 'Mc Indoe Falls', 'Caledonia', 'VT'),
(05051, 'Newbury', 'Orange', 'VT'),
(05052, 'North Hartland', 'Windsor', 'VT'),
(05053, 'North Pomfret', 'Windsor', 'VT'),
(05054, 'North Thetford', 'Orange', 'VT'),
(05055, 'Norwich', 'Windsor', 'VT'),
(05056, 'Plymouth', 'Windsor', 'VT'),
(05058, 'Post Mills', 'Orange', 'VT'),
(05059, 'Quechee', 'Windsor', 'VT'),
(05060, 'Randolph', 'Orange', 'VT'),
(05061, 'Randolph Center', 'Orange', 'VT'),
(05062, 'Reading', 'Windsor', 'VT'),
(05065, 'Sharon', 'Windsor', 'VT'),
(05067, 'South Pomfret', 'Windsor', 'VT'),
(05068, 'South Royalton', 'Windsor', 'VT'),
(05069, 'South Ryegate', 'Caledonia', 'VT'),
(05070, 'South Strafford', 'Orange', 'VT'),
(05071, 'South Woodstock', 'Windsor', 'VT'),
(05072, 'Strafford', 'Orange', 'VT'),
(05073, 'Taftsville', 'Windsor', 'VT'),
(05074, 'Thetford', 'Orange', 'VT'),
(05075, 'Thetford Center', 'Orange', 'VT'),
(05076, 'Topsham', 'Orange', 'VT'),
(05077, 'Tunbridge', 'Orange', 'VT'),
(05079, 'Vershire', 'Orange', 'VT'),
(05081, 'Wells River', 'Orange', 'VT'),
(05083, 'West Fairlee', 'Orange', 'VT'),
(05084, 'West Hartford', 'Windsor', 'VT'),
(05085, 'West Newbury', 'Orange', 'VT'),
(05086, 'Wells River', 'Orange', 'VT'),
(05088, 'Wilder', 'Windsor', 'VT'),
(05089, 'Windsor', 'Windsor', 'VT'),
(05091, 'Woodstock', 'Windsor', 'VT'),
(05101, 'Bellows Falls', 'Windham', 'VT'),
(05141, 'Cambridgeport', 'Windham', 'VT'),
(05142, 'Cavendish', 'Windsor', 'VT'),
(05143, 'Chester', 'Windsor', 'VT'),
(05146, 'Grafton', 'Windham', 'VT'),
(05148, 'Londonderry', 'Windham', 'VT'),
(05149, 'Ludlow', 'Windsor', 'VT'),
(05150, 'North Springfield', 'Windsor', 'VT'),
(05151, 'Perkinsville', 'Windsor', 'VT'),
(05152, 'Peru', 'Bennington', 'VT'),
(05153, 'Proctorsville', 'Windsor', 'VT'),
(05154, 'Saxtons River', 'Windham', 'VT'),
(05155, 'South Londonderry', 'Windham', 'VT'),
(05156, 'Springfield', 'Windsor', 'VT'),
(05158, 'Westminster', 'Windham', 'VT'),
(05159, 'Westminster', 'Windham', 'VT'),
(05161, 'Weston', 'Windsor', 'VT'),
(05201, 'Bennington', 'Bennington', 'VT'),
(05250, 'Arlington', 'Bennington', 'VT'),
(05251, 'Dorset', 'Bennington', 'VT'),
(05252, 'East Arlington', 'Bennington', 'VT'),
(05253, 'East Dorset', 'Bennington', 'VT'),
(05254, 'Manchester', 'Bennington', 'VT'),
(05255, 'Manchester Center', 'Bennington', 'VT'),
(05257, 'North Bennington', 'Bennington', 'VT'),
(05260, 'North Pownal', 'Bennington', 'VT'),
(05261, 'Pownal', 'Bennington', 'VT'),
(05262, 'Shaftsbury', 'Bennington', 'VT'),
(05301, 'Brattleboro', 'Windham', 'VT'),
(05302, 'Brattleboro', 'Windham', 'VT'),
(05303, 'Brattleboro', 'Windham', 'VT'),
(05304, 'Brattleboro', 'Windham', 'VT'),
(05340, 'Bondville', 'Bennington', 'VT'),
(05341, 'East Dover', 'Windham', 'VT'),
(05342, 'Jacksonville', 'Windham', 'VT'),
(05343, 'Jamaica', 'Windham', 'VT'),
(05344, 'Marlboro', 'Windham', 'VT'),
(05345, 'Newfane', 'Windham', 'VT'),
(05346, 'Putney', 'Windham', 'VT'),
(05350, 'Readsboro', 'Bennington', 'VT'),
(05351, 'South Newfane', 'Windham', 'VT'),
(05352, 'Stamford', 'Bennington', 'VT'),
(05353, 'Townshend', 'Windham', 'VT'),
(05354, 'Vernon', 'Windham', 'VT'),
(05355, 'Wardsboro', 'Windham', 'VT'),
(05356, 'West Dover', 'Windham', 'VT'),
(05357, 'West Dummerston', 'Windham', 'VT'),
(05358, 'West Halifax', 'Windham', 'VT'),
(05359, 'West Townshend', 'Windham', 'VT'),
(05360, 'West Wardsboro', 'Windham', 'VT'),
(05361, 'Whitingham', 'Windham', 'VT'),
(05362, 'Williamsville', 'Windham', 'VT'),
(05363, 'Wilmington', 'Windham', 'VT'),
(05401, 'Burlington', 'Chittenden', 'VT'),
(05402, 'Burlington', 'Chittenden', 'VT'),
(05403, 'South Burlington', 'Chittenden', 'VT'),
(05404, 'Winooski', 'Chittenden', 'VT'),
(05405, 'Burlington', 'Chittenden', 'VT'),
(05406, 'Burlington', 'Chittenden', 'VT'),
(05407, 'South Burlington', 'Chittenden', 'VT'),
(05408, 'Burlington', 'Chittenden', 'VT'),
(05439, 'Colchester', 'Chittenden', 'VT'),
(05440, 'Alburgh', 'Grand Isle', 'VT'),
(05441, 'Bakersfield', 'Franklin', 'VT'),
(05442, 'Belvidere Center', 'Lamoille', 'VT'),
(05443, 'Bristol', 'Addison', 'VT'),
(05444, 'Cambridge', 'Lamoille', 'VT'),
(05445, 'Charlotte', 'Chittenden', 'VT'),
(05446, 'Colchester', 'Chittenden', 'VT'),
(05447, 'East Berkshire', 'Franklin', 'VT'),
(05448, 'East Fairfield', 'Franklin', 'VT'),
(05449, 'Colchester', 'Chittenden', 'VT'),
(05450, 'Enosburg Falls', 'Franklin', 'VT'),
(05451, 'Essex', 'Chittenden', 'VT'),
(05452, 'Essex Junction', 'Chittenden', 'VT'),
(05453, 'Essex Junction', 'Chittenden', 'VT'),
(05454, 'Fairfax', 'Chittenden', 'VT'),
(05455, 'Fairfield', 'Franklin', 'VT'),
(05456, 'Ferrisburgh', 'Addison', 'VT'),
(05457, 'Franklin', 'Franklin', 'VT'),
(05458, 'Grand Isle', 'Grand Isle', 'VT'),
(05459, 'Highgate Center', 'Franklin', 'VT'),
(05460, 'Highgate Springs', 'Franklin', 'VT'),
(05461, 'Hinesburg', 'Chittenden', 'VT'),
(05462, 'Huntington', 'Chittenden', 'VT'),
(05463, 'Isle La Motte', 'Grand Isle', 'VT'),
(05464, 'Jeffersonville', 'Lamoille', 'VT'),
(05465, 'Jericho', 'Chittenden', 'VT'),
(05466, 'Jonesville', 'Chittenden', 'VT'),
(05468, 'Milton', 'Chittenden', 'VT'),
(05469, 'Monkton', 'Addison', 'VT'),
(05470, 'Montgomery', 'Franklin', 'VT'),
(05471, 'Montgomery Center', 'Franklin', 'VT'),
(05472, 'New Haven', 'Addison', 'VT'),
(05473, 'North Ferrisburgh', 'Addison', 'VT'),
(05474, 'North Hero', 'Grand Isle', 'VT'),
(05476, 'Richford', 'Franklin', 'VT'),
(05477, 'Richmond', 'Chittenden', 'VT'),
(05478, 'Saint Albans', 'Franklin', 'VT'),
(05479, 'Saint ALbans', 'Franklin', 'VT'),
(05481, 'Saint ALbans Bay', 'Franklin', 'VT'),
(05482, 'Shelburne', 'Chittenden', 'VT'),
(05483, 'Sheldon', 'Franklin', 'VT'),
(05485, 'Sheldon Springs', 'Franklin', 'VT'),
(05486, 'South Hero', 'Grand Isle', 'VT'),
(05487, 'Starksboro', 'Addison', 'VT'),
(05488, 'Swanton', 'Franklin', 'VT'),
(05489, 'Underhill', 'Chittenden', 'VT'),
(05490, 'Underhill Center', 'Chittenden', 'VT'),
(05491, 'Vergennes', 'Addison', 'VT'),
(05492, 'Waterville', 'Lamoille', 'VT'),
(05494, 'Westford', 'Chittenden', 'VT'),
(05495, 'Williston', 'Chittenden', 'VT'),
(05601, 'Montpelier', 'Washington', 'VT'),
(05602, 'Montpelier', 'Washington', 'VT'),
(05603, 'Montpelier', 'Washington', 'VT'),
(05604, 'Montpelier', 'Washington', 'VT'),
(05609, 'Montpelier', 'Washington', 'VT'),
(05620, 'Montpelier', 'Washington', 'VT'),
(05633, 'Montpelier', 'Washington', 'VT'),
(05640, 'Adamant', 'Washington', 'VT'),
(05641, 'Barre', 'Washington', 'VT'),
(05647, 'Cabot', 'Washington', 'VT'),
(05648, 'Calais', 'Washington', 'VT'),
(05649, 'East Barre', 'Washington', 'VT'),
(05650, 'East Calais', 'Washington', 'VT'),
(05651, 'East Montpelier', 'Washington', 'VT'),
(05652, 'Eden', 'Lamoille', 'VT'),
(05653, 'Eden Mills', 'Lamoille', 'VT'),
(05654, 'Graniteville', 'Washington', 'VT'),
(05655, 'Hyde Park', 'Lamoille', 'VT'),
(05656, 'Johnson', 'Lamoille', 'VT'),
(05657, 'Lake Elmore', 'Lamoille', 'VT'),
(05658, 'Marshfield', 'Washington', 'VT'),
(05660, 'Moretown', 'Washington', 'VT'),
(05661, 'Morrisville', 'Lamoille', 'VT'),
(05662, 'Moscow', 'Lamoille', 'VT'),
(05663, 'Northfield', 'Washington', 'VT'),
(05664, 'Northfield Falls', 'Washington', 'VT'),
(05665, 'North Hyde Park', 'Lamoille', 'VT'),
(05666, 'North Montpelier', 'Washington', 'VT'),
(05667, 'Plainfield', 'Washington', 'VT'),
(05669, 'Roxbury', 'Addison', 'VT'),
(05670, 'South Barre', 'Washington', 'VT'),
(05671, 'Waterbury', 'Washington', 'VT'),
(05672, 'Stowe', 'Lamoille', 'VT'),
(05673, 'Waitsfield', 'Washington', 'VT'),
(05674, 'Warren', 'Washington', 'VT'),
(05675, 'Washington', 'Orange', 'VT'),
(05676, 'Waterbury', 'Washington', 'VT'),
(05677, 'Waterbury Center', 'Washington', 'VT'),
(05678, 'Websterville', 'Washington', 'VT'),
(05679, 'Williamstown', 'Orange', 'VT'),
(05680, 'Wolcott', 'Lamoille', 'VT'),
(05681, 'Woodbury', 'Washington', 'VT'),
(05682, 'Worcester', 'Washington', 'VT'),
(05701, 'Rutland', 'Rutland', 'VT'),
(05702, 'Rutland', 'Rutland', 'VT'),
(05730, 'Belmont', 'Rutland', 'VT'),
(05731, 'Benson', 'Rutland', 'VT'),
(05732, 'Bomoseen', 'Rutland', 'VT'),
(05733, 'Brandon', 'Rutland', 'VT'),
(05734, 'Bridport', 'Addison', 'VT'),
(05735, 'Castleton', 'Rutland', 'VT'),
(05736, 'Center Rutland', 'Rutland', 'VT'),
(05737, 'Chittenden', 'Rutland', 'VT'),
(05738, 'Cuttingsville', 'Rutland', 'VT'),
(05739, 'Danby', 'Rutland', 'VT'),
(05740, 'East Middlebury', 'Addison', 'VT'),
(05741, 'East Poultney', 'Rutland', 'VT'),
(05742, 'East Wallingford', 'Rutland', 'VT'),
(05743, 'Fair Haven', 'Rutland', 'VT'),
(05744, 'Florence', 'Rutland', 'VT'),
(05745, 'Forest Dale', 'Rutland', 'VT'),
(05746, 'Gaysville', 'Windsor', 'VT'),
(05747, 'Granville', 'Addison', 'VT'),
(05748, 'Hancock', 'Addison', 'VT'),
(05750, 'Hydeville', 'Rutland', 'VT'),
(05751, 'Killington', 'Rutland', 'VT'),
(05753, 'Middlebury', 'Addison', 'VT'),
(05757, 'Middletown Springs', 'Rutland', 'VT'),
(05758, 'Mount Holly', 'Rutland', 'VT'),
(05759, 'North Clarendon', 'Rutland', 'VT'),
(05760, 'Orwell', 'Addison', 'VT'),
(05761, 'Pawlet', 'Rutland', 'VT'),
(05762, 'Pittsfield', 'Rutland', 'VT'),
(05763, 'Pittsford', 'Rutland', 'VT'),
(05764, 'Poultney', 'Rutland', 'VT'),
(05765, 'Proctor', 'Rutland', 'VT'),
(05766, 'Ripton', 'Addison', 'VT'),
(05767, 'Rochester', 'Windsor', 'VT'),
(05768, 'Rupert', 'Bennington', 'VT'),
(05769, 'Salisbury', 'Addison', 'VT'),
(05770, 'Shoreham', 'Addison', 'VT'),
(05772, 'Stockbridge', 'Windsor', 'VT'),
(05773, 'Wallingford', 'Rutland', 'VT'),
(05774, 'Wells', 'Rutland', 'VT'),
(05775, 'West Pawlet', 'Rutland', 'VT'),
(05776, 'West Rupert', 'Bennington', 'VT'),
(05777, 'West Rutland', 'Rutland', 'VT'),
(05778, 'Whiting', 'Addison', 'VT'),
(05819, 'Saint Johnsbury', 'Caledonia', 'VT'),
(05820, 'Albany', 'Orleans', 'VT'),
(05821, 'Barnet', 'Caledonia', 'VT'),
(05822, 'Barton', 'Orleans', 'VT'),
(05823, 'Beebe Plain', 'Orleans', 'VT'),
(05824, 'Concord', 'Essex', 'VT'),
(05825, 'Coventry', 'Orleans', 'VT'),
(05826, 'Craftsbury', 'Orleans', 'VT'),
(05827, 'Craftsbury Common', 'Orleans', 'VT'),
(05828, 'Danville', 'Caledonia', 'VT'),
(05829, 'Derby', 'Orleans', 'VT'),
(05830, 'Derby Line', 'Orleans', 'VT'),
(05832, 'East Burke', 'Caledonia', 'VT'),
(05833, 'East Charleston', 'Orleans', 'VT'),
(05836, 'East Hardwick', 'Caledonia', 'VT'),
(05837, 'East Haven', 'Essex', 'VT'),
(05838, 'East Saint Johnsbury', 'Caledonia', 'VT'),
(05839, 'Glover', 'Orleans', 'VT'),
(05840, 'Granby', 'Essex', 'VT'),
(05841, 'Greensboro', 'Orleans', 'VT'),
(05842, 'Greensboro Bend', 'Orleans', 'VT'),
(05843, 'Hardwick', 'Caledonia', 'VT'),
(05845, 'Irasburg', 'Orleans', 'VT'),
(05846, 'Island Pond', 'Essex', 'VT'),
(05847, 'Lowell', 'Orleans', 'VT'),
(05848, 'Lower Waterford', 'Caledonia', 'VT'),
(05849, 'Lyndon', 'Caledonia', 'VT'),
(05850, 'Lyndon Center', 'Caledonia', 'VT'),
(05851, 'Lyndonville', 'Caledonia', 'VT'),
(05853, 'Morgan', 'Orleans', 'VT'),
(05855, 'Newport', 'Orleans', 'VT'),
(05857, 'Newport Center', 'Orleans', 'VT'),
(05858, 'North Concord', 'Essex', 'VT'),
(05859, 'North Troy', 'Orleans', 'VT'),
(05860, 'Orleans', 'Orleans', 'VT'),
(05861, 'Passumpsic', 'Caledonia', 'VT'),
(05862, 'Peacham', 'Caledonia', 'VT'),
(05863, 'Saint Johnsbury Center', 'Caledonia', 'VT'),
(05866, 'Sheffield', 'Caledonia', 'VT'),
(05867, 'Sutton', 'Caledonia', 'VT'),
(05868, 'Troy', 'Orleans', 'VT'),
(05871, 'West Burke', 'Caledonia', 'VT'),
(05872, 'West Charleston', 'Orleans', 'VT'),
(05873, 'West Danville', 'Caledonia', 'VT'),
(05874, 'Westfield', 'Orleans', 'VT'),
(05875, 'West Glover', 'Orleans', 'VT'),
(05901, 'Averill', 'Essex', 'VT'),
(05902, 'Beecher Falls', 'Essex', 'VT'),
(05903, 'Canaan', 'Essex', 'VT'),
(05904, 'Gilman', 'Essex', 'VT'),
(05905, 'Guildhall', 'Essex', 'VT'),
(05906, 'Lunenburg', 'Essex', 'VT'),
(05907, 'Norton', 'Essex', 'VT');

-- --------------------------------------------------------

--
-- Table structure for table `tblQuestion`
--

CREATE TABLE `tblQuestion` (
  `pmkQuestionID` int(11) NOT NULL,
  `fldQuestionText` text NOT NULL,
  `fldAttribute1` varchar(64) NOT NULL,
  `fldAttribute2` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblQuestion`
--

INSERT INTO `tblQuestion` (`pmkQuestionID`, `fldQuestionText`, `fldAttribute1`, `fldAttribute2`) VALUES
(1, 'Do you want to do something indoors or outdoors?', 'Indoors', 'Outdoors'),
(2, 'How much are you willing to spend?', 'Less than $30', 'No limit'),
(3, 'Do you want to get any exercise?', 'Yes!', 'No!');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
  `pmkUserID` int(11) NOT NULL,
  `fldEmail` varchar(128) NOT NULL,
  `fldPassword` varchar(256) NOT NULL,
  `fldProfilePic` blob NOT NULL,
  `fldDateJoined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fldConfirmed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`pmkUserID`, `fldEmail`, `fldPassword`, `fldProfilePic`, `fldDateJoined`, `fldConfirmed`) VALUES
(1, 'cole.frost@uvm.edu', '12345678', '', '2020-11-23 17:58:02', 1),
(14, 'wonka17@gmail.com', '$2y$10$yjJpxD.9as6GVEoLPC0OROnCwmJvFG3K.YvtWHd0CUERm2mPLksEC', '', '2020-11-24 03:06:33', 1),
(19, 'kiwan.lee@uvm.edu', '$2y$10$yg581byqikZkbuMJMHd0ieblwtUchmTLROVxGC.Ro7j8zosaULAvu', '', '2020-11-29 03:33:12', 1),
(24, 'tertiaryclass3@gmail.com', '$2y$10$n4J.PWnoc0anuchRj8N4hOljBTRY8H.QhmaqdqLi..P3fjXI9tys2', '', '2020-12-04 16:34:04', 1),
(25, 'colewilliamfrost@gmail.com', '$2y$10$.UxByokGi3M5Ue12YSIfM.AoQ32cGzkOgr8IpDIWpR8D/puajr97K', '', '2020-12-04 18:55:36', 1),
(26, 'mriofrio@uvm.edu', '$2y$10$XcR3sW8SbNYRvRR/BBMpguD7rUKKYduwK/i2CLI/6UlYgbioopnF6', '', '2020-12-05 20:56:48', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblActivity`
--
ALTER TABLE `tblActivity`
  ADD PRIMARY KEY (`pmkActivityID`),
  ADD KEY `pfkCreatedBy` (`pfkCreatedBy`),
  ADD KEY `pfkZipCode` (`pfkZipCode`);

--
-- Indexes for table `tblAttributes`
--
ALTER TABLE `tblAttributes`
  ADD KEY `pfkActivityID` (`pfkActivityID`);

--
-- Indexes for table `tblFavorites`
--
ALTER TABLE `tblFavorites`
  ADD KEY `pfkUserID` (`pfkUserID`),
  ADD KEY `pfkActivityID` (`pfkActivityID`);

--
-- Indexes for table `tblLocation`
--
ALTER TABLE `tblLocation`
  ADD PRIMARY KEY (`pmkZipCode`);

--
-- Indexes for table `tblQuestion`
--
ALTER TABLE `tblQuestion`
  ADD PRIMARY KEY (`pmkQuestionID`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
  ADD PRIMARY KEY (`pmkUserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblActivity`
--
ALTER TABLE `tblActivity`
  MODIFY `pmkActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tblQuestion`
--
ALTER TABLE `tblQuestion`
  MODIFY `pmkQuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `pmkUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblActivity`
--
ALTER TABLE `tblActivity`
  ADD CONSTRAINT `tblActivity_ibfk_2` FOREIGN KEY (`pfkCreatedBy`) REFERENCES `tblUser` (`pmkUserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblActivity_ibfk_3` FOREIGN KEY (`pfkZipCode`) REFERENCES `tblLocation` (`pmkZipCode`);

--
-- Constraints for table `tblAttributes`
--
ALTER TABLE `tblAttributes`
  ADD CONSTRAINT `tblAttributes_ibfk_1` FOREIGN KEY (`pfkActivityID`) REFERENCES `tblActivity` (`pmkActivityID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblFavorites`
--
ALTER TABLE `tblFavorites`
  ADD CONSTRAINT `tblFavorites_ibfk_1` FOREIGN KEY (`pfkUserID`) REFERENCES `tblUser` (`pmkUserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblFavorites_ibfk_2` FOREIGN KEY (`pfkActivityID`) REFERENCES `tblActivity` (`pmkActivityID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
