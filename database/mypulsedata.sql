INSERT INTO `country` (`country_id`, `name`) VALUES
(1, 'INDIA'),
(2, 'JAPAN');


INSERT INTO `superadmin` (`superadmin_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `phone`, `description`, `address`, `gender`, `dob`, `country`, `state`, `district`, `city`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES
(1, 'MPSA18_100001', 'Super Admin', '', 'Admin', 'sa@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '8121815501', 'Super admin', 'HYD', 'male', '11/04/1996', 1, 1, 1, 1, 1, 1, 1, '2018-10-31 14:21:33', '2018-10-31 14:21:33');


INSERT INTO `users` (`user_id`, `unique_id`, `name`, `mname`, `lname`, `email`, `password`, `description`, `country`, `state`, `district`, `city`, `address`, `phone`, `gender`, `dob`, `age`, `patient_type`, `blood_group`, `in_time`, `account_opening_timestamp`, `aadhar`, `height`, `weight`, `blood_pressure`, `sugar_level`, `health_insurance_provider`, `health_insurance_id`, `family_history`, `past_medical_history`, `reg_status`, `is_email`, `is_mobile`, `status`, `created_at`, `modified_at`) VALUES
(1, 'MPU18_100001', 'U1', '', 'U1', 'u1@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'User 1', 1, 1, 1, 1, 'Kurnool', '8121815502', 'male', '11/04/1996', 21, '', 'A+', '', 0, 'Kurnool', '5.6', '59', '120', '100', 'mahi', '1222', 'Nothing', 'not', 1, 1, 2, 1, '2018-11-03 04:15:11', '2018-11-03 04:15:11'),
(2, 'MPU18_100002', 'U2', '', 'U2', 'u2@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'User 2', 0, 0, 0, 0, '', '8121815555', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 1, 2, 1, '2018-11-03 04:15:16', '2018-11-03 04:15:16'),
(3, 'MPU18_100003', 'U3', '', 'U3', 'u3@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'User 3', 0, 0, 0, 0, '', '8121810202', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 1, 2, 1, '2018-11-03 04:15:22', '2018-11-03 04:15:22'),
(4, 'MPU18_100004', 'U4', '', 'U4', 'u4@g.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'User 4', 0, 0, 0, 0, '', '8121818181', '', '', 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 1, 2, 1, '2018-11-03 04:15:28', '2018-11-03 04:15:28');

-- --------------------------------------------------------

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'MyPulse'),
(2, 'system_title', 'MyPulse'),
(3, 'address', 'India'),
(4, 'phone', '77556555656'),
(5, 'paypal_email', ''),
(6, 'currency', ''),
(7, 'system_email', 'mypulecare@gmail.com'),
(8, 'email_password', 'MyPulse@123'),
(9, 'purchase_code', '[ your-purchase-code-here ]'),
(11, 'language', ''),
(12, 'text_align', ''),
(13, 'system_currency_id', '1'),
(14, 'sms_username', 'mypulsecare@gmail.com'),
(15, 'sms_sender', 'TXTLCL'),
(16, 'sms_hash', 'Hp1qPEPiNj0-Q9HXoTR77OZ12cqTlOcohqW928oJzA'),
(17, 'GST', ''),
(19, 'privacy', '<p style=\"text-align:center\"><span style=\"color:#008080\"><span style=\"font-size:16px\"><strong>Capgemini believes that the establishment of trust and privacy is instrumental to the continued growth of the Internet. &nbsp;We also believe that the efficient collection, use and transfer of information serve to enhance the development of the Internet and electronic commerce, provided that such information is handled in a fair and responsible manner.</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><span style=\"color:#008080\"><strong>Introduction</strong></span></h2>\r\n\r\n<p>Data protection is a key concern for Capgemini which has been placing this matter as a priority for long. Hence, transparency regarding the way we process the personal data we collect is a commitment for us. The information provided below intends to provide you all relevant information in relation to the collection and processing of information which may be collected through this website&nbsp;<a href=\"http://www.capgemini.com/\">www.capgemini.com</a>, (hereinafter, &ldquo;the website&rdquo;)</p>\r\n\r\n<p>Capgemini Services SAS (hereinafter, &ldquo;we&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo; or &ldquo;Capgemini&rdquo;) may collect and process personal data relating to you when you visit this website.</p>\r\n\r\n<h2><span style=\"color:#008080\"><span style=\"font-size:16px\"><strong>Processing of Your Personal Data</strong></span></span></h2>\r\n\r\n<p>Generally, you can visit our website without providing any personal data about yourself. However, in order to access some parts of our websites and/or for you to request specific information or services, we may need to collect personal data from you which we will process for the purposes described hereunder.</p>\r\n\r\n<p>As part of pre-contractual and/or contractual obligations, we may process your personal data for:</p>\r\n\r\n<ul>\r\n	<li>answering any requests, queries or inquires you may submit on our website; but also</li>\r\n	<li>enabling you log on certain restricted parts of our website;</li>\r\n	<li>managing your participation to online context</li>\r\n</ul>\r\n\r\n<p>We may also use the personal data you share with us, for:</p>\r\n\r\n<ul>\r\n	<li>maintaining and improving the website as well as to ensuring its security;</li>\r\n	<li>conducting customer satisfaction surveys;</li>\r\n	<li>manage the forums to which you may take part;</li>\r\n	<li>recruitment purposes related when you submit a resume or a job application online; and</li>\r\n	<li>compiling aggregate statistics regarding the use of the website.</li>\r\n</ul>\r\n'),
(20, 'terms', '<p style=\"text-align: center;\"><span style=\"color:#008080\"><span style=\"font-size:22px\"><u><strong>Terms of Use​</strong></u></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>1) <span style=\"color:#008080\"><strong>Acceptance</strong></span></h3>\r\n\r\n<p>By accessing and browsing the Capgemini (the &ldquo;Company&rdquo;) website or by using and/or downloading any content from same, you agree and accept the Terms of Use as set forth below.</p>\r\n\r\n<h3>2) <span style=\"color:#008080\"><strong>Purpose of the website</strong></span></h3>\r\n\r\n<p>All the materials contained in the Company&rsquo;s website are provided for informational purposes only and shall not be construed as a commercial offer, a license, an advisory, fiduciary or professional relationship between you and the Company. No information provided on this site shall be considered a substitute for your independent investigation.</p>\r\n\r\n<p>The information provided on this website may be related to products or services that are not available in your country.</p>\r\n\r\n<h3>3) <span style=\"color:#008080\"><strong>Links to Third-Party Websites</strong></span></h3>\r\n\r\n<p>Links to third-party websites are provided for convenience only and do not imply any approval or endorsement by the Company of the linked sites, even if they may contain the Company&rsquo;s logo, as such sites are beyond the Company&rsquo;s control. Thus, the Company cannot be held responsible for the content of any linked site or any link contained therein.</p>\r\n\r\n<p>You acknowledge that framing the Company&rsquo;s website or any similar process is prohibited.</p>\r\n\r\n<h3>4) <span style=\"color:#008080\"><strong>Intellectual Property</strong></span></h3>\r\n\r\n<p>This website is protected by intellectual property rights and is the exclusive property of the Company. Any material that it contains, including, but not limited to, texts, data, graphics, pictures, sounds, videos, logos, icons or html code is protected under intellectual property law and remains the Company or third party&rsquo;s property.</p>\r\n\r\n<p>You may use this material for personal and non-commercial purposes in accordance with the principles governing intellectual property law. Any other use or modification of the content of the Company&rsquo;s website without the Company&rsquo;s prior written authorization is prohibited.</p>\r\n\r\n<p>Registered Trademarks:</p>\r\n\r\n<ul>\r\n	<li>Rightshore&reg; is a trademark belonging to Capgemini</li>\r\n	<li>Collaborative Business Experience&trade; is a trademark belonging to Capgemini</li>\r\n</ul>\r\n\r\n<h3>5) <span style=\"color:#008080\"><strong>Warranty and Liability</strong></span></h3>\r\n\r\n<p>All materials, including downloadable software, contained in the Company&rsquo;s website is provided &laquo;as is&raquo; and without warranty of any kind to the extent allowed by the applicable law; While the Company will use reasonable efforts to provide reliable information through its website, the Company does not warrant that this website is free of inaccuracies, errors and/or omissions, viruses, worms, Trojan horses and the like, or that its content is appropriate for your particular use or up to date, and the Company reserves the right to change the information at any time without notice. The Company does not warrant any results derived from the use of any software available on this site. You are solely responsible for any use of the materials contained in this site.</p>\r\n\r\n<p>The information contained in this site does not extend or modify the warranty that may apply to you as a result of a contractual relationship with the Company.</p>\r\n\r\n<p>The Company will not be liable for any indirect, consequential or incidental damages, including but not limited to lost profits or revenues, business interruption, loss of data arising out of or in connection with the use, inability to use or reliance on any material contained in this site or any linked site.</p>\r\n\r\n<p>In any event, the liability of the Company for direct damages arising out of or in connection with the use, inability to use or reliance on any material contained in this site or any linked site shall not exceed the amount of Euros 1,000</p>\r\n\r\n<h3>6) <span style=\"color:#008080\"><strong>Online Privacy Policy &ndash; Use of Cookies</strong></span></h3>\r\n\r\n<p>Please check our&nbsp;<a href=\"https://www.capgemini.com/privacy-policy\">Online Privacy Policy</a></p>\r\n\r\n<h3>7) <span style=\"color:#008080\"><strong>Users&rsquo; Comments</strong></span></h3>\r\n\r\n<p>The Company does not assume any obligation to monitor the information that you may post on its website.</p>\r\n\r\n<p>You warrant that any information, Materials (the term &ldquo;Material&rdquo; is intended to cover all projects, files or other attachments sent to us) or comments other than personal data, that you may transmit to the Company through the website does not infringe intellectual property rights or any other applicable law. Such information, Materials or comments, will be treated as non-confidential and non proprietary. By submitting any information or material, you give the Company an unlimited and irrevocable license to use, execute, show, modify and transmit such information, Material or comments, including any underlying idea, concept or know-how (the term &ldquo;Material&rdquo; is intended to cover all projects, files or other attachments sent to us). The Company reserves the right to use such information in any way it chooses.</p>\r\n\r\n<h3>8) <span style=\"color:#008080\"><strong>Applicable law &ndash; Severability</strong></span></h3>\r\n\r\n<p>Any controversy or claim arising out of or related to the Terms of Use shall be governed by French law. The Commercial Court of Paris will have exclusive jurisdiction.</p>\r\n\r\n<p>If any provision of these Terms of Use is held by a court to be illegal, invalid or unenforceable, the remaining provisions shall remain in full force and effect.</p>\r\n\r\n<h3>9) <span style=\"color:#008080\"><strong>Modifications of the Terms of Use</strong></span></h3>\r\n\r\n<p>The Company reserves the right to change the Terms of Use under which this website is offered at any time and without notice. You will be automatically bound by these modifications when you use this site, and should periodically read the Terms of Use.</p>\r\n');

-- --------------------------------------------------------


INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (1, 1, 'LAA', 'LAAA', 'Laa');
INSERT INTO `license` (`license_id`, `license_category_id`, `license_code`, `name`, `description`) VALUES (2, 2, 'HAA', 'HAA', 'HAA');


INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (1, 'MPCL_19001', 'Clinic', 'Clinic');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (2, 'MPHL_19002', 'Hospital', 'Hospital');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (3, 'MPMS_19003', 'Medical Store', 'Medical Store');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (4, 'MPML_19004', 'Medical Lab ', 'Medical Lab ');
INSERT INTO `license_category` (`license_category_id`, `license_category_code`, `name`, `description`) VALUES (5, 'MPBB_19005', 'Blood Bank', 'Blood Bank');


